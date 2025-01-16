@extends('backend.layout.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ $product->name }}
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary d-none d-sm-inline-block">
                        <x-dashboard.icon.edit/>
                        Düzenle
                    </a>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ürün Detayları</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">SKU</label>
                            <div>{{ $product->sku }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <div>{{ $product->price }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İndirimli Fiyat</label>
                            <div>{{ $product->discount_price }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <div>{{ $product->stock }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <div>{!! $product->desc !!}</div>
                        </div>
                    </div>
                </div>

                @if($product->relatedProducts->count() > 0)
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">İlişkili Ürünler</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Ürün</th>
                                        <th>SKU</th>
                                        <th>Fiyat</th>
                                        <th>Stok</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->relatedProducts as $relatedProduct)
                                    <tr>
                                        <td>{{ $relatedProduct->name }}</td>
                                        <td>{{ $relatedProduct->sku }}</td>
                                        <td>{{ $relatedProduct->price }}</td>
                                        <td>{{ $relatedProduct->stock }}</td>
                                        <td>
                                            <a href="{{ route('product.show', $relatedProduct->id) }}" class="btn btn-primary btn-icon">
                                                <x-dashboard.icon.eye/>
                                            </a>
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Özellikler</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kategoriler</label>
                            <div>
                                @foreach($product->categories as $category)
                                    <span class="badge bg-blue">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Etiketler</label>
                            <div>
                                @foreach($product->tags as $tag)
                                    <span class="badge bg-azure">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öne Çıkan</label>
                            <div>
                                @if($product->featured)
                                    <span class="badge bg-green">Evet</span>
                                @else
                                    <span class="badge bg-red">Hayır</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Durum</label>
                            <div>
                                @if($product->status)
                                    <span class="badge bg-green">Aktif</span>
                                @else
                                    <span class="badge bg-red">Pasif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 