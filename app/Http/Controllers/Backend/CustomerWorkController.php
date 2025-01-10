<?php

namespace App\Http\Controllers\Backend;

use App\Models\CustomerWork;
use App\Models\CustomerOffer;
use App\Enums\CustomerWorkStatusEnum;
use App\Enums\CustomerOfferStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GoogleCalendarTrait;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerPayment;
use App\Enums\CustomerWorkPaymentStatusEnum;

class CustomerWorkController extends Controller
{
    use GoogleCalendarTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = CustomerWork::with([
            'customer:id,company_name,authorized_person',
            'offer:id,offer_no,name',
            'createdBy:id,name',
            'updatedBy:id,name'
        ])->latest()->paginate(10);
        
        return view('backend.customer-work.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offers = CustomerOffer::whereDoesntHave('customerWork')
            ->with(['customer', 'items'])
            ->get();

        return view('backend.customer-work.create', compact('offers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'offer_id' => 'required|exists:customer_offers,id',
            'start_date' => 'required|date',
            'delivery_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'advance_payment' => 'nullable|numeric|min:0'
        ]);

        $offer = CustomerOffer::with('items')->findOrFail($validated['offer_id']);

        // Toplam tutarı hesapla
        $totalAmount = $offer->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        // Varsa ön ödemeyi ayarla
        $advancePayment = $validated['advance_payment'] ?? 0;
        $remainingPayment = $totalAmount - $advancePayment;

        DB::beginTransaction();
        try {
            // İş kaydını oluştur
            $work = CustomerWork::create([
                ...$validated,
                'customer_id' => $offer->customer_id,
                'status' => CustomerWorkStatusEnum::PENDING,
                'payment_status' => $advancePayment > 0 ? CustomerWorkPaymentStatusEnum::PARTIAL : CustomerWorkPaymentStatusEnum::PENDING,
                'total_amount' => $totalAmount,
                'advance_payment' => $advancePayment,
                'remaining_payment' => $remainingPayment,
                'total_paid' => $advancePayment,
                'total_remaining' => $remainingPayment,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

            // Ön ödeme varsa ödeme kaydı oluştur
            if ($advancePayment > 0) {
                CustomerPayment::create([
                    'customer_work_id' => $work->id,
                    'payment_date' => now(),
                    'amount' => $advancePayment,
                    'payment_type' => 'advance',
                    'description' => 'Ön ödeme',
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id()
                ]);

                $work->last_payment_date = now();
                $work->save();
            }

            DB::commit();
            return redirect()->route('customer-works.show', $work)
                ->with('success', 'İş kaydı başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'İş kaydı oluşturulurken bir hata oluştu.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerWork $customerWork)
    {
        $customerWork->load(['customer', 'offer', 'createdBy', 'updatedBy']);
        return view('backend.customer-work.show', compact('customerWork'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerWork $customerWork)
    {
        return view('backend.customer-work.edit', compact('customerWork'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerWork $customerWork)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'delivery_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'progress' => 'required|integer|min:0|max:100',
            'total_amount' => 'required|numeric|min:0'
        ]);

        $customerWork->fill($validated);
        $customerWork->updated_by = Auth::id();
        $customerWork->save();

        // Google Calendar'ı güncelle
        if (auth()->user()->google_calendar_token && $customerWork->google_calendar_event_id) {
            $this->updateGoogleCalendarEvent($customerWork);
        }

        return redirect()->route('customer-works.show', $customerWork)
            ->with('success', 'İş kaydı başarıyla güncellendi.');
    }

    /**
     * Update work status
     */
    public function updateStatus(Request $request, CustomerWork $customerWork)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_column(CustomerWorkStatusEnum::cases(), 'value'))
        ]);

        $customerWork->status = $validated['status'];
        $customerWork->updated_by = Auth::id();
        
        if ($validated['status'] === CustomerWorkStatusEnum::COMPLETED->value) {
            $customerWork->completed_date = now();
        }
        
        $customerWork->save();

        return redirect()->back()->with('success', 'İş durumu başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerWork $customerWork)
    {
        // Google Calendar'dan sil
        if (auth()->user()->google_calendar_token && $customerWork->google_calendar_event_id) {
            $this->deleteGoogleCalendarEvent($customerWork);
        }

        $customerWork->delete();
        return redirect()->route('customer-works.index')
            ->with('success', 'İş kaydı başarıyla silindi.');
    }
}
