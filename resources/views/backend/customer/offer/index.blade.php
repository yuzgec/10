@extends('backend.layout.app')

@section('content')

<div class="card">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <div class="card-title">
            <x-dashboard.icon.menu-list/> Teklifler [{{ $offers->total() }}]
        </div>
        <div class="card-actions d-flex">
            <div class="d-none d-sm-inline-block p-1">
                <form>
                    <div class="input-icon mb-3">
                        <input type="text" class="form-control" name="q" placeholder="Arama" value="{{ request('q')}}">
                        <span class="input-icon-addon">
                            <x-dashboard.icon.search/>
                        </span>
                    </div>
                </form>
            </div>
            
            @if(request('q'))
            <div class="p-1">
                <a href="{{ route('customer-offers.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
                    <x-dashboard.icon.refresh/>
                </a>
            </div>
            @endif
            <div class="p-1">
                <a href="{{ route('customer-offers.index')}}" class="btn btn-icon">
                    <x-dashboard.icon.back/>
                </a>
            </div>
            <div class="p-1">
                <a href="{{ route('offer-templates.create')}}" title="Şablon Oluştur" class="btn btn-icon" >
                    <x-dashboard.icon.theme/>
                </a>
            </div>
            <div class="p-1">
                <a href="{{ route('customer-offers.create')}}" title="Teklif Oluştur" class="btn btn-icon" >
                    <x-dashboard.icon.add/>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>Teklif No</th>
                        <th>Müşteri</th>
                        <th>Başlık</th>
                        <th>Tutar</th>
                        <th>Durum</th>
                        <th>Teklif Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>{{ $offer->offer_no }}</td>
                            <td>
                                <a href="{{ route('customer-offers.show', $offer->customer_id) }}" class="text-reset">
                                    {{ $offer->customer->company_name }}
                                </a>
                            </td>
                            <td>{{ $offer->name }}</td>
                            <td>
                                {{ number_format($offer->items->sum('total'), 2) }} 
                                {{ $offer->currency?->value }}
                            </td>
                            <td>
                                <span class="badge text-white p-2 bg-{{ $offer->status->color() }}">
                                    {{ $offer->status->title() }}
                                </span>
                            </td>
                            <td>{{ $offer->offer_date->format('d.m.Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('customer-offers.show', $offer) }}" 
                                        class="btn btn-info btn-sm" title="Görüntüle">
                                        <x-dashboard.icon.eye/>
                                    </a>
                                    
                                    <a href="{{ route('customer-offers.edit', $offer) }}" 
                                        class="btn btn-primary btn-sm" title="Düzenle">
                                        <x-dashboard.icon.edit/>
                                    </a>

                                    {{-- <a href="{{ route('customer-offers.download-pdf', $offer) }}" 
                                        class="btn btn-secondary btn-sm" title="PDF İndir">
                                        <x-dashboard.icon.pdf/>
                                    </a>

                                    @if(!$offer->is_sent)
                                        <form action="{{ route('customer-offers.send-email', $offer) }}" 
                                                method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Mail Gönder">
                                                <x-dashboard.icon.envelope/>
                                            </button>
                                        </form>
                                    @endif --}}

                                    <form action="{{ route('customer-offers.destroy', $offer) }}" 
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Bu teklifi silmek istediğinize emin misiniz?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Sil">
                                            <x-dashboard.icon.trash/>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Henüz teklif bulunmuyor</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $offers->links() }}
        </div>
    </div>
</div>

@endsection 