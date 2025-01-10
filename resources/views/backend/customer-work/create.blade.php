@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Yeni İş Oluştur</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-works.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customer-works.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Teklif Seçin *</label>
                            <select name="offer_id" id="offer_id" class="form-select @error('offer_id') is-invalid @enderror" required>
                                <option value="">Seçin</option>
                                @foreach($offers as $offer)
                                    <option value="{{ $offer->id }}" 
                                            data-total="{{ $offer->items->sum(function($item) {
                                                $subtotal = $item->unit * $item->amount;
                                                $discountAmount = $subtotal * ($item->discount / 100);
                                                $afterDiscount = $subtotal - $discountAmount;
                                                $taxAmount = $afterDiscount * ($item->tax / 100);
                                                return $afterDiscount + $taxAmount;
                                            }) }}"
                                            data-currency="{{ $offer->currency }}">
                                        {{ $offer->offer_no }} - {{ $offer->customer->company_name }} ({{ number_format($offer->items->sum('total'), 2) }} {{ $offer->currency }})
                                    </option>
                                @endforeach
                            </select>
                            @error('offer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Başlangıç Tarihi *</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teslim Tarihi *</label>
                            <input type="date" name="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" required>
                            @error('delivery_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Toplam Tutar</label>
                            <div class="input-group">
                                <input type="text" id="total_display" class="form-control" readonly>
                                <span class="input-group-text" id="currency_display"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notlar</label>
                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('customer-works.index') }}" class="btn btn-secondary">Geri Dön</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('offer_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const total = selectedOption.dataset.total;
    const currency = selectedOption.dataset.currency;
    
    document.getElementById('total_display').value = total ? new Intl.NumberFormat('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(total) : '';
    document.getElementById('currency_display').textContent = currency || '';
});
</script>
@endpush 