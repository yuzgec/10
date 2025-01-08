<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Models\CustomerOffer;
use App\Models\CustomerOfferItem;
use App\Enums\CustomerOfferStatusEnum;
use App\Enums\CurrencyEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use App\Models\OfferTemplate;

class CustomerOfferController extends Controller
{
    public function index()
    {
        $offers = CustomerOffer::with(['customer', 'items'])
            ->when(request('q'), function($query) {
                $query->whereHas('customer', function($q) {
                    $q->where('company_name', 'like', '%' . request('q') . '%');
                })
                ->orWhere('offer_no', 'like', '%' . request('q') . '%')
                ->orWhere('title', 'like', '%' . request('q') . '%');
            })
            ->latest()
            ->paginate(25);
            

        return view('backend.customer.offer.index', compact('offers'));
    }

    public function create()
    {
        $customers = Customer::all();
        $templates = OfferTemplate::with('items')->get();
        $currencies = CurrencyEnum::cases();
        $statuses = CustomerOfferStatusEnum::cases();
        return view('backend.customer.offer.create', compact('customers', 'templates', 'currencies', 'statuses'));
    }

    public function store(Request $request)
    {
        try {
            // Son teklif numarasını al ve yeni numara oluştur
            $lastOffer = CustomerOffer::latest()->first();
            $lastNumber = $lastOffer ? intval(substr($lastOffer->offer_no, 3)) : 0;
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            $offer_no = 'GO-' . $newNumber;

            // Teklifi oluştur
            $offer = CustomerOffer::create(array_merge(
                $request->except('items'),
                ['offer_no' => $offer_no]
            ));

            // Teklif kalemlerini kaydet
            if($request->items) {
                foreach($request->items as $item) {
                    $offer->items()->create([
                        'item_name' => $item['item_name'],
                        'unit' => $item['unit'],
                        'amount' => $item['amount'],
                        'discount' => $item['discount'],
                        'tax' => $item['tax'],
                        'total' => $item['total']
                    ]);
                }
            }

            alert()->success('Başarılı', 'Teklif başarıyla oluşturuldu.');
            return redirect()->route('customer-offers.show', $offer);

        } catch (\Exception $e) {
            alert()->error('Hata', 'Teklif oluşturulurken bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function show(CustomerOffer $offer)
    {
        $offer->load(['customer', 'items', 'payments']);
        return view('backend.customer.offer.show', compact('offer'));
    }

    public function edit(CustomerOffer $offer)
    {
        $customers = Customer::orderBy('company_name')->get();
        $currencies = CurrencyEnum::cases();
        $statuses = CustomerOfferStatusEnum::cases();

        return view('backend.customer.offer.edit', compact('offer', 'customers', 'currencies', 'statuses'));
    }

    public function update(Request $request, CustomerOffer $offer)
    {
        try {
            tap($offer)->update($request->except('items'));

            // Teklif kalemlerini güncelle
            if($request->items) {
                $offer->items()->delete(); // Mevcut kalemleri sil
                foreach($request->items as $item) {
                    $offer->items()->create([
                        'item_name' => $item['item_name'],
                        'unit' => $item['unit'],
                        'amount' => $item['amount'],
                        'discount' => $item['discount'],
                        'tax' => $item['tax'],
                        'total' => $item['total']
                    ]);
                }
            }

            alert()->success('Başarılı', 'Teklif başarıyla güncellendi.');
            return redirect()->route('customer-offers.show', $offer);

        } catch (\Exception $e) {
            alert()->error('Hata', 'Teklif güncellenirken bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(CustomerOffer $offer)
    {
        try {
            $offer->delete();
            alert()->success('Başarılı', 'Teklif başarıyla silindi.');
            return redirect()->route('customer-offers.index');
        } catch (\Exception $e) {
            alert()->error('Hata', 'Teklif silinirken bir hata oluştu.');
            return back();
        }
    }

    public function sendEmail(CustomerOffer $offer)
    {
        try {
            $offer->sendEmail();
            $offer->update([
                'is_sent' => true,
                'sent_at' => now()
            ]);
            return back()->with('success', 'Teklif başarıyla gönderildi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Teklif gönderilirken bir hata oluştu.');
        }
    }

    public function downloadPdf(CustomerOffer $offer)
    {
        return $offer->generatePDF();
    }

    public function convertCurrency(Request $request)
    {
        try {
            $amount = $request->amount;
            $fromCurrency = $request->from_currency;
            $toCurrency = $request->to_currency;

            // Aynı para birimi ise çevirme yapma
            if ($fromCurrency === $toCurrency) {
                return response()->json([
                    'success' => true,
                    'amount' => $amount,
                    'from' => $fromCurrency,
                    'to' => $toCurrency
                ]);
            }

            // TRY'den TRY'ye çevrim ise
            if ($fromCurrency === 'TRY' && $toCurrency === 'TRY') {
                return response()->json([
                    'success' => true,
                    'amount' => $amount,
                    'from' => $fromCurrency,
                    'to' => $toCurrency
                ]);
            }

            $convertedAmount = ExchangeRate::convert($amount, $fromCurrency, $toCurrency);

            if ($convertedAmount === null) {
                throw new \Exception('Döviz kuru bulunamadı');
            }

            return response()->json([
                'success' => true,
                'amount' => round($convertedAmount, 2),
                'from' => $fromCurrency,
                'to' => $toCurrency
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function getCurrentRate(Request $request)
    {
        $currencyCode = $request->currency;
        $rate = ExchangeRate::getCurrentRate($currencyCode);

        return response()->json([
            'success' => true,
            'currency' => $currencyCode,
            'rate' => $rate
        ]);
    }
}
