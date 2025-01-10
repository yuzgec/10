@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Ödeme Detayı</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-payments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                    <a href="{{ route('customer-payments.edit', $customerPayment) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Düzenle
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ödeme Bilgileri</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Müşteri:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerPayment->customerWork->customer->company_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>İş/Teklif No:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('customer-works.show', $customerPayment->customerWork) }}">
                                {{ $customerPayment->customerWork->offer->offer_no }}
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Ödeme Tipi:</strong>
                        </div>
                        <div class="col-md-8">
                            @if($customerPayment->payment_type === 'advance')
                                <span class="badge badge-info">Ön Ödeme</span>
                            @elseif($customerPayment->payment_type === 'progress')
                                <span class="badge badge-warning">Ara Ödeme</span>
                            @else
                                <span class="badge badge-success">Son Ödeme</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tutar:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ number_format($customerPayment->amount, 2) }} TL
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Ödeme Tarihi:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerPayment->payment_date->format('d.m.Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Durum:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge badge-{{ $customerPayment->status->color() }}">
                                {{ $customerPayment->status->title() }}
                            </span>
                        </div>
                    </div>

                    @if($customerPayment->description)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Açıklama:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerPayment->description }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Durum Güncelle</h5>
                    
                    <form action="{{ route('customer-payments.update-status', $customerPayment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="status">Yeni Durum</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach(\App\Enums\CustomerPaymentStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}" 
                                            {{ $customerPayment->status === $status->value ? 'selected' : '' }}>
                                        {{ $status->title() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Durumu Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Diğer Bilgiler</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Oluşturan:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerPayment->createdBy->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Güncelleyen:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerPayment->updatedBy->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Oluşturulma:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerPayment->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Güncellenme:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerPayment->updated_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 