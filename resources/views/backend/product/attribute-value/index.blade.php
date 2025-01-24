@extends('backend.layout.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <div>
                    <h3 class="card-title">Özellik Değerleri</h3>
                </div>
                <div class="card-actions d-flex align-items-center gap-1">
                    <select id="attribute-filter" class="form-select" onchange="filterValues(this.value)">
                        <option value="">Tüm Özellikler</option>
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}" 
                                {{ request('attribute_id') == $attribute->id ? 'selected' : '' }}>
                                {{ $attribute->translate('tr')->name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('product-attribute-values.create') }}" class="btn btn-primary">
                        Yeni Ekle
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th style="width: 40px"></th>
                                <th>Özellik</th>
                                <th>Değer Adı</th>
                                <th>Renk</th>
                                <th>Sıralama</th>
                                <th>Durum</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody class="sortable" data-url="{{ route('product-attribute-values.sort') }}">
                            @forelse($values as $value)
                                <tr data-id="{{ $value->id }}">
                                    <td>
                                        <x-dashboard.icon.menu-list/>
                                    </td>
                                    <td>{{ $value->attribute->translate('tr')->name }}</td>
                                    <td>{{ $value->translate('tr')->name }}</td>
                                    <td>
                                        @if($value->color_code)
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">{{ $value->color_code }}</span>
                                                <div style="width: 20px; height: 20px; border-radius: 4px; background-color: {{ $value->color_code }}"></div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $value->rank }}</td>
                                    <td>
                                        <span class="badge bg-{{ $value->status ? 'success' : 'danger' }}">
                                            {{ $value->status ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('product-attribute-values.edit', $value) }}" class="btn btn-icon btn-primary">
                                                <x-dashboard.icon.edit/>
                                            </a>
                                            
                                            <form action="{{ route('product-attribute-values.destroy', $value) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-danger" 
                                                        onclick="return confirm('Emin misiniz?')">
                                                    <x-dashboard.icon.delete/>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Henüz özellik değeri eklenmemiş</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $values->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Filtreleme
    function filterValues(attributeId) {
        let url = new URL(window.location.href);
        if (attributeId) {
            url.searchParams.set('attribute_id', attributeId);
        } else {
            url.searchParams.delete('attribute_id');
        }
        window.location.href = url.toString();
    }

    new Sortable(document.querySelector('.sortable'), {
    handle: '.handle',
    animation: 150,
    ghostClass: 'bg-primary-subtle',
    onEnd: function(evt) {
        const rows = evt.to.querySelectorAll('tr');
        const items = Array.from(rows).map((tr, index) => ({
            id: tr.dataset.id,
            rank: index + 1
        }));

        fetch(evt.to.dataset.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ items })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Sıralama güncellenirken bir hata oluştu');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // İsteğe bağlı: Toast message göster
                console.log('Sıralama güncellendi');
            }
        })
        .catch(error => {
            console.error('Hata:', error);
            // İsteğe bağlı: Hata mesajı göster
        });
    }
});
</script>
@endpush

@endsection 