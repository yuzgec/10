<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ExchangeRate extends Model
{
    protected $fillable = [
        'currency_code',
        'buying_rate',
        'selling_rate',
        'effective_rate',
        'rate_date'
    ];

    protected $casts = [
        'rate_date' => 'date',
        'buying_rate' => 'decimal:4',
        'selling_rate' => 'decimal:4',
        'effective_rate' => 'decimal:4',
    ];

    // Belirli bir para birimi için güncel kur bilgisini al
    public static function getCurrentRate($currencyCode)
    {
        if ($currencyCode === 'TRY') {
            return null;
        }

        $today = now()->format('Y-m-d');
        
        $rate = self::where('currency_code', $currencyCode)
                    ->where('rate_date', $today)
                    ->first();

        if (!$rate) {
            self::fetchCurrentRates();
            $rate = self::where('currency_code', $currencyCode)
                        ->where('rate_date', $today)
                        ->first();
        }

        return $rate;
    }

    // TCMB'den güncel kurları çek
    public static function fetchCurrentRates()
    {
        try {
            $response = Http::get('https://www.tcmb.gov.tr/kurlar/today.xml');
            $xml = simplexml_load_string($response->body());
            
            $today = now()->format('Y-m-d');

            foreach ($xml->Currency as $currency) {
                $currencyCode = (string)$currency['CurrencyCode'];
                
                // Sadece USD, EUR ve GBP kurlarını al
                if (!in_array($currencyCode, ['USD', 'EUR', 'GBP'])) {
                    continue;
                }

                self::updateOrCreate(
                    [
                        'currency_code' => $currencyCode,
                        'rate_date' => $today
                    ],
                    [
                        'buying_rate' => (float)str_replace(',', '.', $currency->ForexBuying),
                        'selling_rate' => (float)str_replace(',', '.', $currency->ForexSelling),
                        'effective_rate' => (float)str_replace(',', '.', $currency->BanknoteSelling),
                    ]
                );
            }

            return true;
        } catch (\Exception $e) {
            \Log::error('Döviz kuru çekilirken hata: ' . $e->getMessage());
            throw new \Exception('Döviz kurları güncellenirken bir hata oluştu.');
        }
    }

    // Belirli bir tutarı bir para biriminden diğerine çevir
    public static function convert($amount, $fromCurrency, $toCurrency, $rateType = 'selling_rate')
    {
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        if ($fromCurrency === 'TRY' && $toCurrency === 'TRY') {
            return $amount;
        }

        $today = now()->format('Y-m-d');

        // TRY'den yabancı para birimine çevirme
        if ($fromCurrency === 'TRY') {
            $rate = self::where('currency_code', $toCurrency)
                       ->where('rate_date', $today)
                       ->first();

            if (!$rate) {
                self::fetchCurrentRates();
                $rate = self::where('currency_code', $toCurrency)
                           ->where('rate_date', $today)
                           ->first();
            }

            if ($rate) {
                return $amount / $rate->$rateType;
            }
        }

        // Yabancı para biriminden TRY'ye çevirme
        if ($toCurrency === 'TRY') {
            $rate = self::where('currency_code', $fromCurrency)
                       ->where('rate_date', $today)
                       ->first();

            if (!$rate) {
                self::fetchCurrentRates();
                $rate = self::where('currency_code', $fromCurrency)
                           ->where('rate_date', $today)
                           ->first();
            }

            if ($rate) {
                return $amount * $rate->$rateType;
            }
        }

        // Yabancı para biriminden yabancı para birimine çevirme
        $fromRate = self::where('currency_code', $fromCurrency)
                        ->where('rate_date', $today)
                        ->first();

        $toRate = self::where('currency_code', $toCurrency)
                      ->where('rate_date', $today)
                      ->first();

        if (!$fromRate || !$toRate) {
            self::fetchCurrentRates();
            
            $fromRate = self::where('currency_code', $fromCurrency)
                           ->where('rate_date', $today)
                           ->first();

            $toRate = self::where('currency_code', $toCurrency)
                         ->where('rate_date', $today)
                         ->first();
        }

        if ($fromRate && $toRate) {
            // Önce TRY'ye çevir, sonra hedef para birimine
            $tryAmount = $amount * $fromRate->$rateType;
            return $tryAmount / $toRate->$rateType;
        }

        throw new \Exception('Döviz kuru bulunamadı. Lütfen önce kurları güncelleyin.');
    }
}
