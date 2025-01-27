@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h3 class="card-title"> <x-dashboard.icon.cart/> Ürünler</h3>
                <span class="ms-3 badge bg-blue">{{ $products->total() }}</span>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <x-dashboard.icon.add /> Basit Ürün
                </a>
                <a href="{{ route('product.createVariable') }}" class="btn btn-purple">
                    <x-dashboard.icon.add /> Varyantlı Ürün
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Tüm Kategoriler</option>
                        @foreach($categories->where('parent_id', 7) as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->name }} ({{ $category->products_count }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Tüm Durumlar</option>
                        <option value="1" @selected(request('status') === '1')>Aktif</option>
                        <option value="0" @selected(request('status') === '0')>Pasif</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <form class="d-flex gap-2">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Ürün ara..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary">
                            <x-dashboard.icon.search />
                            Ara
                        </button>
                    </form>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->getFirstMediaUrl('image', 'small') }}" 
                                         alt="{{ $product->name }}"
                                         class="avatar">
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="{{ route('product.edit', $product) }}" class="text-reset">
                                            {{ $product->name }}
                                        </a>
                                        @if($product->category)
                                            <span class="text-muted small">
                                                {{ $product->category->name }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    <span class="badge text-white p-2 {{ $product->type->badge() }}">
                                        {{ $product->type->label() }}
                                    </span>
                                </td>
                                <td>{{ number_format($product->price, 2) }} ₺</td>
                                <td>
                                    @if($product->type->value === 1)
                                        {{ $product->stock }}
                                    @else
                                        {{ $product->variations_count }} varyant
                                    @endif
                                </td>
                                <td>
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               @checked($product->status)
                                               onchange="updateStatus('{{ route('product.update', $product) }}', this)">
                                    </label>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        @if($product->type->value === 1)
                                            <a href="{{ route('product.edit', $product) }}" class="btn btn-icon btn-primary">
                                                <x-dashboard.icon.edit />
                                            </a>
                                        @else
                                            <a href="{{ route('product.editVariable', $product) }}" class="btn btn-icon btn-primary">
                                                <x-dashboard.icon.edit />
                                            </a>
                                        @endif
                                        
                                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger" 
                                                    onclick="return confirm('Emin misiniz?')">
                                                <x-dashboard.icon.delete />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Henüz ürün eklenmemiş
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateStatus(url, element) {
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: element.checked
        })
    });
}
</script>
@endpush
@endsection 