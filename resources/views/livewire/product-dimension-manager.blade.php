<div class="card mb-3">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h3 class="card-title">
            <x-dashboard.icon.box/> Ürün Boyutları
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ağırlık (kg)</label>
                <input type="number" 
                    step="0.01" 
                    class="form-control" 
                    wire:model="weight"
                    name="weight">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Boyut Birimi</label>
                <select class="form-select" wire:model.live="dimension_unit" name="dimension_unit" @if(!$dimension_unit) disabled @endif>
                    <option value="">Seçiniz</option>
                    <option value="cm">Santimetre (cm)</option>
                    <option value="m">Metre (m)</option>
                    <option value="mm">Milimetre (mm)</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Uzunluk</label>
                <input type="number" 
                    step="0.01" 
                    class="form-control" 
                    wire:model="length"
                    wire:change="calculateVolume"
                    name="length">
            </div>

            <div class="col-md-4">
                <label class="form-label">Genişlik</label>
                <input type="number" 
                    step="0.01" 
                    class="form-control" 
                    wire:model="width"
                    wire:change="calculateVolume"
                    name="width">
            </div>

            <div class="col-md-4">
                <label class="form-label">Yükseklik</label>
                <input type="number" 
                    step="0.01" 
                    class="form-control" 
                    wire:model="height"
                    wire:change="calculateVolume"
                    name="height">
            </div>

            @if($volume > 0)
            <div class="col-12 mt-3">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Toplam Hacim: {{ $volume }} dm³ (desimetre küp)
                </div>
            </div>
            @endif
        </div>
    </div>
</div> 