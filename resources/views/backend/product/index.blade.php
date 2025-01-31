@extends('backend.layout.app')

@section('content')<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="page-title">@lang('Ürün Yönetimi')</h2>
                <div class="ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            @lang('Yeni Ürün')
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Filtreleme -->
            <div class="row g-2 mb-4">
                <div class="col-4 col-md-3 col-xl-2">
                    <select class="form-select" onchange="window.location.href = this.value">
                        <option value="{{ route('product.index') }}">@lang('Tüm Tipler')</option>
                        @foreach($productTypes as $type)
                            <option value="{{ route('product.index', ['type' => $type->value]) }}" 
                                {{ request('type') == $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-4 col-md-3 col-xl-2">
                    <select class="form-select" onchange="window.location.href = this.value">
                        <option value="{{ route('product.index') }}">@lang('Tüm Kategoriler')</option>
                        @foreach($categories as $category)
                            <option value="{{ route('product.index', ['category' => $category->id]) }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->translate('tr')->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-xl-8">
                    <form method="GET" class="input-icon">
                        <input type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="@lang('Ürün ara...')" 
                            value="{{ request('search') }}">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                    </form>
                </div>
            </div>

            <!-- Ürün Tablosu -->
            <div class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th class="w-1">@lang('Görsel')</th>
                            <th>@lang('Ürün Bilgileri')</th>
                            <th>@lang('Fiyat')</th>
                            <th>@lang('Stok')</th>
                            <th>@lang('Durum')</th>
                            <th class="w-1 text-end">@lang('İşlemler')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->hasMedia('default'))
                                        <div class="avatar avatar-md" style="background-image: url({{ $product->getFirstMediaUrl('default', 'thumb') }})"></div>
                                    @else
                                        <div class="avatar avatar-md bg-secondary-lt">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 8h.01" />
                                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{ $product->translate('tr')->name }}</div>
                                            <div class="text-muted text-h5">SKU: {{ $product->sku }}</div>
                                            <div class="mt-2">
                                                @foreach($product->categories as $category)
                                                    <span class="badge bg-info-lt me-1">
                                                        {{ $category->translate('tr')->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($product->type === App\Enums\ProductTypeEnum::VARIABLE)
                                        <div class="text-danger">{{ $product->variations->min('price') }} TL</div>
                                        <div class="text-success">{{ $product->variations->max('price') }} TL</div>
                                    @else
                                        <div class="text-primary">{{ $product->price }} TL</div>
                                    @endif
                                </td>
                                <td>
                                    @if($product->type === App\Enums\ProductTypeEnum::VARIABLE)
                                        <span class="badge bg-purple-lt">
                                            {{ $product->variations_count }} @lang('Varyasyon')
                                        </span>
                                    @else
                                        <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}-lt">
                                            {{ $product->stock }} @lang('Adet')
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <label class="form-check form-switch m-0">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input" 
                                            {{ $product->status ? 'checked' : '' }}
                                            onclick="toggleStatus({{ $product->id }})">
                                    </label>
                                </td>
                                <td class="text-end">
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('product.edit', $product) }}" 
                                           class="btn btn-icon" title="@lang('Düzenle')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('product.destroy', $product) }}" 
                                              id="delete-form-{{ $product->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-icon" 
                                                    title="@lang('Sil')"
                                                    onclick="confirmDelete({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
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
                                <td colspan="6" class="text-center">
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M9 10l.01 0" />
                                                <path d="M15 10l.01 0" />
                                                <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                            </svg>
                                        </div>
                                        <p class="empty-title">@lang('Kayıtlı ürün bulunamadı')</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Sayfalama -->
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">@lang('Toplam') {{ $products->total() }} @lang('kayıttan') {{ $products->firstItem() }} - {{ $products->lastItem() }} @lang('gösteriliyor')</p>
                <ul class="pagination m-0 ms-auto">
                    {{ $products->appends(request()->query())->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('scripts')
<script>
function toggleStatus(productId) {
    fetch(`/admin/products/${productId}/toggle-status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        }
    }).then(response => {
        if (!response.ok) alert('@lang('Durum güncellenemedi')');
    });
}

function confirmDelete(productId) {
    if (confirm('@lang('Bu ürünü silmek istediğinize emin misiniz?')')) {
        document.getElementById(`delete-form-${productId}`).submit();
    }
}
</script>
@endpush