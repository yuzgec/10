@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Ödeme Düzenle</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-payments.show', $customerPayment) }}" class="btn btn-secondary">
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
                    <form action="{{ route('customer-payments.update', $customerPayment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="customer_work_id">İş Seçin <span class="text-danger">*</span></label>
                            <select name="customer_work_id" id="customer_work_id" 
                                    class="form-control @error('customer_work_id') is-invalid @enderror" required>
                                <option value="">Seçin</option>
                                @foreach($works as $work)
                                    <option value="{{ $work->id }}" 
                                            {{ (old('customer_work_id', $customerPayment->customer_work_id) == $work->id) ? 'selected' : '' }}>
                                        {{ $work->offer->offer_no }} - {{ $work->customer->company_name }} 
                                        ({{ number_format($work->total_amount, 2) }} TL)
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_work_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_type">Ödeme Tipi <span class="text-danger">*</span></label>
                            <select name="payment_type" id="payment_type" 
                                    class="form-control @error('payment_type') is-invalid @enderror" required>
                                <option value="">Seçin</option>
                                <option value="advance" {{ old('payment_type', $customerPayment->payment_type) === 'advance' ? 'selected' : '' }}>
                                    Ön Ödeme
                                </option>
                                <option value="progress" {{ old('payment_type', $customerPayment->payment_type) === 'progress' ? 'selected' : '' }}>
                                    Ara Ödeme
                                </option>
                                <option value="final" {{ old('payment_type', $customerPayment->payment_type) === 'final' ? 'selected' : '' }}>
                                    Son Ödeme
                                </option>
                            </select>
                            @error('payment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount">Ödeme Tutarı <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="amount" id="amount" 
                                   class="form-control @error('amount') is-invalid @enderror"
                                   value="{{ old('amount', $customerPayment->amount) }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_date">Ödeme Tarihi <span class="text-danger">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" 
                                   class="form-control @error('payment_date') is-invalid @enderror"
                                   value="{{ old('payment_date', $customerPayment->payment_date->format('Y-m-d')) }}" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Açıklama</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $customerPayment->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#customer_work_id').select2({
            theme: 'bootstrap-5',
            placeholder: 'İş seçin'
        });

        $('#payment_type').select2({
            theme: 'bootstrap-5',
            placeholder: 'Ödeme tipi seçin'
        });
    });
</script>
@endpush 