@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title"> <x-dashboard.icon.cart/> Ürünler</h3>
            <div>
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <x-dashboard.icon.add />
                    Yeni Ekle
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Ürün Adı</th>
                        <th>SKU</th>
                        <th>Tip</th>
                        <th>Fiyat</th>
                        <th>Stok</th>
                        <th>Durum</th>
                        <th class="w-1"></th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <x-dashboard.index.image :model="$product" />
                     
                        <td>
                            {{ $product->name }}
                            @if($product->featured)
                                <span class="badge text-white  bg-orange">Öne Çıkan</span>
                            @endif
                        </td>
                        <td>
                            @if($product->isVariable())
                                <small class="text-muted">
                                    {{ $product->variations_count }} varyant
                                </small>
                            @else
                                {{ $product->sku }}
                            @endif
                        </td>
                        <td>
                            <span class="badge text-white {{ $product->type->badge() }}">
                                {{ $product->type->label() }}
                            </span>
                        </td>
                        <td>
                            @if($product->isVariable())
                                @php
                                    $minPrice = $product->variations->min('price');
                                    $maxPrice = $product->variations->max('price');
                                @endphp
                                {{ number_format($minPrice, 2) }} ₺ - {{ number_format($maxPrice, 2) }} ₺
                            @else
                                {{ number_format($product->price, 2) }} ₺
                            @endif
                        </td>
                        <td>
                            @if($product->isVariable())
                                {{ $product->variations->sum('stock') }}
                            @else
                                {{ $product->stock }}
                            @endif
                        </td>
                        <td>
                            <span class="badge text-white  bg-{{ $product->status ? 'success' : 'danger' }}">
                                {{ $product->status ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <x-dashboard.index.delete-edit-button :model="$product" route="product"/>

                    </tr>

                    <x-dashboard.index.delete-modal :model="$product" route="product"/>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="card-footer d-flex align-items-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection