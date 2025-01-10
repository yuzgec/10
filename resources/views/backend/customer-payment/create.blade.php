@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Yeni Ödeme Ekle</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-payments.index') }}" class="btn btn-secondary">
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
                    <form action="{{ route('customer-payments.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="customer_work_id">İş <span class="text-danger">*</span></label>
                            <select name="customer_work_id" id="customer_work_id" 
                                    class="form-control @error('customer_work_id') is-invalid @enderror" required>
                                <option value="">İş seçin</option>
                                @foreach($works as $work)
                                    <option value="{{ $work->id }}" 
                                            {{ old('customer_work_id', $customerWork?->id) == $work->id ? 'selected' : '' }}
                                            data-offer-id="{{ $work->offer_id }}"
                                            data-remaining-amount="{{ $work->total_remaining }}">
                                        {{ $work->customer->company_name }} - {{ $work->offer->name }}
                                        (Kalan: {{ number_format($work->total_remaining, 2) }} TL)
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_work_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="remaining-amount-info" class="text-muted"></small>
                        </div>

                        <input type="hidden" name="offer_id" id="offer_id" value="{{ old('offer_id') }}">

                        <div class="form-group mb-3">
                            <label for="payment_type">Ödeme Tipi <span class="text-danger">*</span></label>
                            <select name="payment_type" id="payment_type" 
                                    class="form-control @error('payment_type') is-invalid @enderror" required>
                                <option value="">Ödeme tipi seçin</option>
                                @foreach(\App\Enums\CustomerPaymentTypeEnum::cases() as $type)
                                    <option value="{{ $type->value }}" {{ old('payment_type') == $type->value ? 'selected' : '' }}>
                                        {{ $type->title() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount">Ödeme Tutarı <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="amount" id="amount" 
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount') }}" required>
                                <span class="input-group-text">TL</span>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_date">Ödeme Tarihi <span class="text-danger">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" 
                                   class="form-control @error('payment_date') is-invalid @enderror"
                                   value="{{ old('payment_date', date('Y-m-d')) }}" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Açıklama</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Kaydet
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
        function formatMoney(amount) {
            return new Intl.NumberFormat('tr-TR', { 
                minimumFractionDigits: 2,
                maximumFractionDigits: 2 
            }).format(amount);
        }

        function updateOfferIdAndAmount() {
            var selectedOption = $('#customer_work_id').find('option:selected');
            var offerId = selectedOption.data('offer-id');
            var remainingAmount = selectedOption.data('remaining-amount');
            
            if (selectedOption.val()) {
                $('#offer_id').val(offerId);
                $('#amount').attr('max', remainingAmount);
                $('#remaining-amount-info').html(
                    '<div class="alert alert-info mt-2">' +
                    'Kalan Tutar: <strong>' + formatMoney(remainingAmount) + ' TL</strong>' +
                    '</div>'
                );
                
                // Debug için
                console.log('Seçilen iş ID:', selectedOption.val());
                console.log('Seçilen teklif ID:', offerId);
                console.log('Kalan tutar:', remainingAmount);
            } else {
                $('#offer_id').val('');
                $('#amount').removeAttr('max');
                $('#remaining-amount-info').text('');
            }
        }

        $('#customer_work_id').select2({
            theme: 'bootstrap-5',
            placeholder: 'İş seçin'
        }).on('change', updateOfferIdAndAmount);

        $('#payment_type').select2({
            theme: 'bootstrap-5',
            placeholder: 'Ödeme tipi seçin'
        });

        // Sayfa yüklendiğinde seçili iş varsa güncelle
        if ($('#customer_work_id').val()) {
            updateOfferIdAndAmount();
        }

        // Tutar değiştiğinde kontrol
        $('#amount').on('input', function() {
            var amount = parseFloat($(this).val() || 0);
            var max = parseFloat($(this).attr('max') || 0);
            
            if (amount > max) {
                alert('Ödeme tutarı kalan tutardan fazla olamaz!');
                $(this).val(max);
            }
        });

        // Form gönderilmeden önce kontrol
        $('form').on('submit', function(e) {
            var selectedWork = $('#customer_work_id').val();
            var offerId = $('#offer_id').val();
            var selectedType = $('#payment_type').val();
            var amount = $('#amount').val();
            var paymentDate = $('#payment_date').val();

            console.log('Form submission:', {
                work_id: selectedWork,
                offer_id: offerId,
                payment_type: selectedType,
                amount: amount,
                payment_date: paymentDate
            });

            if (!selectedWork || !offerId || !selectedType || !amount || !paymentDate) {
                e.preventDefault();
                alert('Lütfen tüm zorunlu alanları doldurun.');
                return false;
            }

            return true;
        });
    });
</script>
@endpush 