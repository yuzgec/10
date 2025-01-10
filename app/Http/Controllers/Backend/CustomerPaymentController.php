<?php

namespace App\Http\Controllers\Backend;

use App\Models\CustomerWork;
use App\Models\CustomerPayment;
use App\Enums\CustomerWorkPaymentStatusEnum;
use App\Enums\CustomerPaymentStatusEnum;
use App\Enums\CustomerPaymentTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = CustomerPayment::with(['customerWork', 'offer'])
            ->latest()
            ->paginate(10);
            
        return view('backend.customer-payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customerWork = null;
        if ($request->has('work_id')) {
            $customerWork = CustomerWork::with(['customer', 'offer'])->find($request->work_id);
        }

        // İşleri getir ve kalan tutarları hesapla
        $works = CustomerWork::with(['customer', 'offer', 'payments'])
            ->get()
            ->map(function ($work) {
                // Her iş için toplam ödenen tutarı hesapla
                $totalPaid = $work->payments->sum('amount');
                $work->total_paid = $totalPaid ?? 0;
                $work->total_remaining = $work->total_amount - $work->total_paid;
                return $work;
            })
            ->filter(function ($work) {
                // Sadece borcu olanları göster
                return $work->total_remaining > 0;
            })
            ->values(); // Array indexlerini yeniden düzenle

        return view('backend.customer-payment.create', compact('works', 'customerWork'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Ödeme form verileri:', $request->all());

        $validated = $request->validate([
            'customer_work_id' => 'required|exists:customer_works,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|in:' . implode(',', CustomerPaymentTypeEnum::values()),
            'description' => 'nullable|string'
        ]);

        // payment_type'ı integer'a çevir
        $validated['payment_type'] = (int) $validated['payment_type'];

        \Log::info('Doğrulanmış veriler:', $validated);

        try {
            $work = CustomerWork::with(['offer', 'payments'])->findOrFail($validated['customer_work_id']);
            
            // Toplam ödenen tutarı hesapla
            $totalPaid = $work->payments->sum('amount') ?? 0;
            $work->total_paid = $totalPaid;
            $work->total_remaining = $work->total_amount - $totalPaid;
            
            \Log::info('İş kaydı:', [
                'id' => $work->id,
                'offer_id' => $work->offer_id,
                'total_amount' => $work->total_amount,
                'total_paid' => $work->total_paid,
                'total_remaining' => $work->total_remaining
            ]);
            
            // Ödeme tutarını kontrol et
            if ($validated['amount'] > $work->total_remaining) {
                return back()->with('error', 'Ödeme tutarı kalan tutardan fazla olamaz.');
            }

            DB::beginTransaction();
            try {
                // Ödemeyi kaydet
                $payment = new CustomerPayment();
                $payment->customer_work_id = $validated['customer_work_id'];
                $payment->offer_id = $work->offer_id;
                $payment->amount = $validated['amount'];
                $payment->payment_date = $validated['payment_date'];
                $payment->payment_type = $validated['payment_type'];
                $payment->description = $validated['description'];
                $payment->status = CustomerPaymentStatusEnum::PENDING->value;
                $payment->created_by = auth()->id();
                $payment->updated_by = auth()->id();
                
                \Log::info('Ödeme kaydı oluşturuluyor:', [
                    'customer_work_id' => $payment->customer_work_id,
                    'offer_id' => $payment->offer_id,
                    'amount' => $payment->amount,
                    'payment_date' => $payment->payment_date,
                    'payment_type' => $payment->payment_type,
                    'status' => $payment->status,
                    'created_by' => $payment->created_by,
                    'updated_by' => $payment->updated_by
                ]);

                $payment->save();

                // İş kaydını güncelle
                $work->total_paid = $totalPaid + $validated['amount'];
                $work->total_remaining = $work->total_amount - $work->total_paid;
                $work->last_payment_date = $validated['payment_date'];
                
                // Ödeme durumunu güncelle
                if ($work->total_remaining <= 0) {
                    $work->payment_status = CustomerWorkPaymentStatusEnum::COMPLETED;
                } elseif ($work->total_paid > 0) {
                    $work->payment_status = CustomerWorkPaymentStatusEnum::PARTIAL;
                }

                $work->save();

                DB::commit();
                return redirect()->route('customer-payments.show', $payment)
                    ->with('success', 'Ödeme başarıyla kaydedildi.');
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Ödeme kaydedilirken hata: ' . $e->getMessage());
                \Log::error('Hata detayı:', ['exception' => $e]);
                return back()->with('error', 'Ödeme kaydedilirken bir hata oluştu: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            \Log::error('İş kaydı bulunurken hata: ' . $e->getMessage());
            \Log::error('Hata detayı:', ['exception' => $e]);
            return back()->with('error', 'İş kaydı bulunamadı.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPayment $customerPayment)
    {
        $customerPayment->load(['customerWork', 'offer', 'createdBy', 'updatedBy']);
        return view('backend.customer-payment.show', compact('customerPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerPayment $customerPayment)
    {
        $works = CustomerWork::with('customer')->get();
        return view('backend.customer-payment.edit', compact('customerPayment', 'works'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerPayment $customerPayment)
    {
        $validated = $request->validate([
            'customer_work_id' => 'required|exists:customer_works,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_type' => 'required|in:' . implode(',', CustomerPaymentTypeEnum::values()),
            'description' => 'nullable|string'
        ]);

        // payment_type'ı integer'a çevir
        $validated['payment_type'] = (int) $validated['payment_type'];

        $customerPayment->fill($validated);
        $customerPayment->updated_by = Auth::id();
        $customerPayment->save();

        return redirect()->route('customer-payments.show', $customerPayment)
            ->with('success', 'Ödeme kaydı başarıyla güncellendi.');
    }

    /**
     * Update payment status
     */
    public function updateStatus(Request $request, CustomerPayment $customerPayment)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', CustomerPaymentStatusEnum::values())
        ]);

        $customerPayment->status = $validated['status'];
        $customerPayment->updated_by = Auth::id();
        $customerPayment->save();

        return redirect()->back()->with('success', 'Ödeme durumu başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerPayment $customerPayment)
    {
        $customerPayment->delete();
        return redirect()->route('customer-payments.index')
            ->with('success', 'Ödeme kaydı başarıyla silindi.');
    }
} 