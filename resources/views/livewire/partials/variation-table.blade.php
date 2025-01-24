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

    <!-- Toplu İşlemler -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="number" 
                    class="form-control" 
                    wire:model="bulkPrice" 
                    placeholder="Tüm varyasyonlara uygulanacak fiyat">
                <button type="button"
                    class="btn btn-primary" 
                    wire:click.prevent="applyBulkPrice">
                <x-dashboard.icon.save class="me-1"/> Uygula
                </button>
            </div>
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
                    <x-dashboard.icon.save class="me-1"/> Oluştur
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
                            <th>Görsel</th>
                            <th>Varyasyon</th>
                            <th>SKU</th>
                            <th>Fiyat</th>
                            <th>İndirimli Fiyat</th>
                            <th>Stok</th>
                            <th class="text-center" style="width: 100px">Varsayılan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($variations as $index => $variation)
                            <tr>
                                <td style="width: 120px">
                                    <div class="avatar-upload">
                                        <input type="file" 
                                               name="variations[{{ $index }}][image]" 
                                               class="d-none"
                                               id="variation-image-{{ $index }}"
                                               accept="image/*">
                                        <label for="variation-image-{{ $index }}" 
                                               class="avatar-preview border rounded cursor-pointer d-flex align-items-center justify-content-center" 
                                               style="width: 80px; height: 80px;">
                                            <x-dashboard.icon.gallery class="text-muted"/>
                                        </label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ collect($variation['values'])->pluck('name')->join(' / ') }}
                                </td>
                                <td style="width: 150px">
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           wire:model.defer="variations.{{ $index }}.sku">
                                </td>
                                <td style="width: 150px">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">₺</span>
                                        <input type="number" 
                                               class="form-control" 
                                               wire:model.defer="variations.{{ $index }}.price">
                                    </div>
                                </td>
                                <td style="width: 150px">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">₺</span>
                                        <input type="number" 
                                               class="form-control" 
                                               wire:model.defer="variations.{{ $index }}.discount_price">
                                    </div>
                                </td>
                                <td style="width: 100px">
                                    <input type="number" 
                                           class="form-control form-control-sm" 
                                           wire:model.defer="variations.{{ $index }}.stock">
                                </td>
                                <td class="text-center align-middle">
                                    <input type="radio" 
                                           class="form-check-input" 
                                           name="default_variation" 
                                           wire:model="defaultVariation"
                                           value="{{ $index }}">
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