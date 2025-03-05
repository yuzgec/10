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

    <div class="d-flex justify-content-between mb-3">
        <h4>Varyasyon Kombinasyonları</h4>
        <button type="button" class="btn btn-primary" wire:click="generateCombinations">
            Kombinasyonları Oluştur
        </button>
    </div>

    @if(count($combinations) > 0)
        <div class="table-responsive">
            <table class="table table-vcenter table-bordered">
                <thead>
                    <tr>
                        @foreach($selectedAttributes as $attrData)
                            @if(!empty($attrData['id']))
                                @php
                                    $attribute = App\Models\Shop\Attr::find($attrData['id']);
                                @endphp
                                @if($attribute)
                                    <th>{{ $attribute->getTranslation('name', app()->getLocale()) }}</th>
                                @endif
                            @endif
                        @endforeach
                        <th>SKU</th>
                        <th>Fiyat</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($combinations as $index => $combination)
                        <tr>
                            @foreach($combination['attributes'] as $attrId => $valueId)
                                <td>
                                    @php
                                        $value = App\Models\Shop\AttrValue::find($valueId);
                                    @endphp
                                    @if($value)
                                        {{ $value->getTranslation('name', app()->getLocale()) }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <input type="text" class="form-control" 
                                       wire:model="combinations.{{ $index }}.sku" 
                                       placeholder="SKU">
                            </td>
                            <td>
                                <input type="number" class="form-control" 
                                       wire:model="combinations.{{ $index }}.price" 
                                       step="0.01" min="0" placeholder="Fiyat">
                            </td>
                            <td>
                                <input type="number" class="form-control" 
                                       wire:model="combinations.{{ $index }}.stock" 
                                       min="0" placeholder="Stok">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <button type="button" class="btn btn-success" wire:click="saveVariations">
                Varyasyonları Kaydet
            </button>
        </div>
    @else
        <div class="alert alert-info">
            Henüz kombinasyon oluşturulmadı. Lütfen özellikleri seçin ve "Kombinasyonları Oluştur" butonuna tıklayın.
        </div>
    @endif
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
@endpush 