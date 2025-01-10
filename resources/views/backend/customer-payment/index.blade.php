@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Ödeme Listesi</h4>
                <div class="page-title-right">
                    <a href="{{ route('customer-payments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Ödeme Ekle
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Müşteri</th>
                                    <th>İş</th>
                                    <th>Ödeme Tipi</th>
                                    <th>Tutar</th>
                                    <th>Ödeme Tarihi</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->customerWork->customer->company_name }}</td>
                                        <td>
                                            <a href="{{ route('customer-works.show', $payment->customerWork) }}">
                                                {{ $payment->customerWork->offer->offer_no }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($payment->payment_type === 'advance')
                                                <span class="badge badge-info">Ön Ödeme</span>
                                            @elseif($payment->payment_type === 'progress')
                                                <span class="badge badge-warning">Ara Ödeme</span>
                                            @else
                                                <span class="badge badge-success">Son Ödeme</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($payment->amount, 2) }} TL</td>
                                        <td>{{ $payment->payment_date->format('d.m.Y') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $payment->status->color() }}">
                                                {{ $payment->status->title() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('customer-payments.show', $payment) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('customer-payments.edit', $payment) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('customer-payments.destroy', $payment) }}" 
                                                  method="POST" 
                                                  class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Emin misiniz?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Henüz ödeme kaydı bulunmuyor</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 