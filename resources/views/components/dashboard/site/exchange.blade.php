@php
    $exchangeRates = App\Models\ExchangeRate::whereIn('currency_code', ['USD', 'EUR', 'GBP'])
        ->where('rate_date', now()->format('Y-m-d'))
        ->get();
@endphp
<div class="nav-item dropdown ">
    <a href="#" class="nav-link" data-bs-toggle="dropdown" tabindex="-1">
        <span class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                <path d="M12 3v3m0 12v3"></path>
            </svg>
            Döviz
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">
        @foreach($exchangeRates as $rate)
        <div class="dropdown-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-3">
                    <strong>{{ $rate->currency_code }}</strong>
                </div>
                <div class="text-end">
                    <div class="small text-success">Alış : {{ number_format($rate->buying_rate, 4) }}</div>
                    <div class="small text-danger">Satış : {{ number_format($rate->selling_rate, 4) }}</div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="dropdown-divider"></div>
        <div class="dropdown-item text-center">
            <small class="text-muted">{{ now()->format('d.m.Y H:i') }}</small>
        </div>
    </div>
</div>