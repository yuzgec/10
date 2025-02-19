@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <!-- Başlık ve Yeni Ekle Butonu -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Ürünler</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('product.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Yeni Ürün Ekle
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtreler -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('product.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Ürün Ara..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <select name="brand_id" class="form-select">
                        <option value="">Marka Seçin</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @selected(request('brand_id') == $brand->id)>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Durum</option>
                        <option value="1" @selected(request('status') === '1')>Aktif</option>
                        <option value="0" @selected(request('status') === '0')>Pasif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filtrele</button>
                    <a href="{{ route('product.index') }}" class="btn btn-link">Sıfırla</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Ürün Listesi -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Ürün Adı</th>
                            <th>SKU</th>
                            <th>Marka</th>
                            <th>Fiyat</th>
                            <th>Stok</th>
                            <th>Durum</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->getFirstMediaUrl('image', 'thumb') }}" 
                                         alt="{{ $product->name }}"
                                         class="avatar avatar-md">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ optional($product->brand)->name }}</td>
                                <td>{{ number_format($product->price, 2) }} ₺</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->status ? 'success' : 'danger' }}">
                                        {{ $product->status ? 'Aktif' : 'Pasif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('product.edit', $product) }}" class="btn btn-icon btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger" 
                                                    onclick="return confirm('Emin misiniz?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Ürün bulunamadı</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 