<div class="mt-4">
    <!-- Bilgilendirme -->
    <div class="alert alert-info mb-4">
        <div class="d-flex">
            <div>
                <x-dashboard.icon.info class="alert-icon"/>
            </div>
            <div>
                <h4 class="alert-title">Varyasyon Yönetimi</h4>
                <div class="text-muted">
                    Toplu işlemler ile hızlıca fiyat atayabilir veya SKU oluşturabilirsiniz. 
                    Birden fazla varyasyonu varsayılan olarak işaretleyebilirsiniz.
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <h4>Varyasyon Listesi</h4>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" 
                    class="form-control" 
                    wire:model="skuPrefix" 
                    placeholder="SKU öneki girin">
                <button type="button"
                    class="btn btn-primary" 
                    wire:click.prevent="generateSKUs">
                    Toplu SKU Oluştur
                </button>
            </div>
        </div>
    </div>

    <!-- Varyasyon Tablosu -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Varyasyonlar</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Varyasyon</th>
                            <th>SKU</th>
                            <th>Fiyat</th>
                            <th>Stok</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($variations as $index => $variation)
                            <tr>
                                <td>
                                    @foreach($variation['values'] as $valueId)
                                        @php
                                            $attributeValue = \App\Models\Shop\AttributeValue::find($valueId);
                                            $attribute = $attributeValue->attribute;
                                        @endphp
                                        <span class="badge bg-blue me-1">
                                            {{ $attribute->name }}: {{ $attributeValue->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <input type="text" 
                                        class="form-control form-control-sm"
                                        wire:model="variations.{{ $index }}.sku">
                                </td>
                                <td>
                                    <input type="number" 
                                        class="form-control form-control-sm"
                                        step="0.01"
                                        wire:model="variations.{{ $index }}.price">
                                </td>
                                <td>
                                    <input type="number" 
                                        class="form-control form-control-sm"
                                        wire:model="variations.{{ $index }}.stock">
                                </td>
                                <td>
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" 
                                            type="checkbox"
                                            wire:model="variations.{{ $index }}.status">
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-preview:hover {
    background-color: #f8f9fa;
}
.cursor-pointer {
    cursor: pointer;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</script>
@endpush 
</style> 