@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">İş Detayı</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-works.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                    <a href="{{ route('customer-works.edit', $customerWork) }}" class="btn btn-primary">
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
                    <h5 class="card-title mb-4">İş Bilgileri</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Müşteri:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->customer->company_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Teklif No:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->offer->offer_no }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Başlangıç Tarihi:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->start_date->format('d.m.Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Teslim Tarihi:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->delivery_date->format('d.m.Y') }}
                        </div>
                    </div>

                    @if($customerWork->completed_date)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tamamlanma Tarihi:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->completed_date->format('d.m.Y') }}
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Toplam Tutar:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ number_format($customerWork->total_amount, 2) }} TL
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>İlerleme:</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $customerWork->progress }}%" 
                                     aria-valuenow="{{ $customerWork->progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ $customerWork->progress }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Durum:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge badge-{{ $customerWork->status->color() }}">
                                {{ $customerWork->status->title() }}
                            </span>
                        </div>
                    </div>

                    @if($customerWork->description)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Açıklama:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->description }}
                        </div>
                    </div>
                    @endif

                    @if($customerWork->notes)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Notlar:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $customerWork->notes }}
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
                    
                    <form action="{{ route('customer-works.update-status', $customerWork) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="status">Yeni Durum</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach(\App\Enums\CustomerWorkStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}" 
                                            {{ $customerWork->status === $status ? 'selected' : '' }}>
                                        {{ $status->title() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Durumu Güncelle
                        </button>
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
                            {{ $customerWork->createdBy->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Güncelleyen:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerWork->updatedBy->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Oluşturulma:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerWork->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Güncellenme:</strong>
                        </div>
                        <div class="col-md-6">
                            {{ $customerWork->updated_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 