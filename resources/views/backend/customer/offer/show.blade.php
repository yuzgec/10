@extends('backend.layout.app')

@section('content')
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">
                    <x-dashboard.icon.eye/> Teklif Detayı - {{ $offer->offer_no }}
                </h3>
                <div class="card-actions">
                    <a href="{{ route('customer-offers.index') }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/> Geri
                    </a>
                   
                        <a href="{{ route('customer-offers.edit', $offer) }}" class="btn btn-primary">
                            <x-dashboard.icon.edit/> Düzenle
                        </a>
                        {{-- <a href="{{ route('customer-offers.download-pdf', $offer) }}" class="btn btn-warning" target="_blank">
                            <x-dashboard.icon.pdf/> PDF İndir
                        </a> --}}
                        {{-- <form action="{{ route('customer-offers.send-email', $offer) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info" {{ $offer->is_sent ? 'disabled' : '' }}>
                                <x-dashboard.icon.envelope/> {{ $offer->is_sent ? 'Mail Gönderildi' : 'Mail Gönder' }}
                            </button>
                        </form> --}}
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-status-top bg-blue"></div>
                <div class="card-body">

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Teklif Bilgileri</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Müşteri:</label>
                                    <div>{{ $offer->customer->company_name }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Teklif No:</label>
                                    <div>{{ $offer->offer_no }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Para Birimi:</label>
                                    <div>{{ $offer->currency }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Teklif Başlığı:</label>
                                    <div>{{ $offer->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Teklif Kalemleri</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>İş</th>
                                            <th>Adet</th>
                                            <th>Birim Fiyat</th>
                                            <th>İndirim (%)</th>
                                            <th>KDV (%)</th>
                                            <th class="text-end">Toplam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                            $discountTotal = 0;
                                            $taxTotal = 0;
                                            $grandTotal = 0;
                                        @endphp
                                        @foreach($offer->items as $item)
                                            @php
                                                $itemSubtotal = $item->unit * $item->amount;
                                                $itemDiscount = $itemSubtotal * ($item->discount / 100);
                                                $afterDiscount = $itemSubtotal - $itemDiscount;
                                                $itemTax = $afterDiscount * ($item->tax / 100);
                                                
                                                $subtotal += $itemSubtotal;
                                                $discountTotal += $itemDiscount;
                                                $taxTotal += $itemTax;
                                                $grandTotal += ($afterDiscount + $itemTax);
                                            @endphp
                                            <tr>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->unit }}</td>
                                                <td>{{ number_format($item->amount, 2) }} {{ $offer->currency }}</td>
                                                <td>{{ $item->discount }}%</td>
                                                <td>{{ $item->tax }}%</td>
                                                <td class="text-end">{{ number_format($afterDiscount + $itemTax, 2) }} {{ $offer->currency }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">Ara Toplam:</td>
                                            <td class="text-end">{{ number_format($subtotal, 2) }} {{ $offer->currency }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">İndirim Toplam:</td>
                                            <td class="text-end">-{{ number_format($discountTotal, 2) }} {{ $offer->currency }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">KDV Toplam:</td>
                                            <td class="text-end">{{ number_format($taxTotal, 2) }} {{ $offer->currency }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">Genel Toplam:</td>
                                            <td class="text-end">{{ number_format($grandTotal, 2) }} {{ $offer->currency }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Açıklama</h3>
                        </div>
                        <div class="card-body">
                            <div>{!! $offer->desc !!}</div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Şartlar</h3>
                        </div>
                        <div class="card-body">
                            <div>{!! $offer->terms !!}</div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">İç Notlar</h3>
                        </div>
                        <div class="card-body">
                            <div>{!! $offer->note !!}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-status-top bg-blue"></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Teklif Durumu:</label>
                        <div>
                            <span class="badge text-white p-2 bg-{{ $offer->status->color() }}">
                                {{ $offer->status->title() }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Teklif Tarihi:</label>
                        <div>{{ $offer->offer_date->format('d.m.Y') }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Geçerlilik Tarihi:</label>
                        <div>{{ $offer->valid_until?->format('d.m.Y') ?? 'Belirtilmemiş' }}</div>
                    </div>

                   

                    @if($offer->is_sent)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mail Gönderim Tarihi:</label>
                            <div>{{ $offer->sent_at->format('d.m.Y H:i') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            @if($offer->payments->count() > 0)
                <div class="card mt-3">
                    <div class="card-status-top bg-blue"></div>
                    <div class="card-header">
                        <h3 class="card-title">Ödemeler</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Tarih</th>
                                        <th>Tutar</th>
                                        <th>Durum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offer->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_date->format('d.m.Y') }}</td>
                                            <td>{{ number_format($payment->amount, 2) }} {{ $offer->currency }}</td>
                                            <td>
                                                <span class="badge bg-{{ $payment->status->color() }}">
                                                    {{ $payment->status->title() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection