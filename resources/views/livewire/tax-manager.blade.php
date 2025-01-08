<div class="card">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h4 class="card-title"><x-dashboard.icon.tax/> Vergi</h4>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label required">Vergi Durumu</label>
            <select wire:model.live="taxStatus" name="tax_status" class="form-select">
                <option value="none">Vergisiz</option>
                <option value="taxable">Vergilendirilebilir</option>
            </select>
        </div>

        @if($showTaxClass)
        <div class="mb-3">
            <label class="form-label">Vergi Sınıfı</label>
            <select wire:model="taxClassId" name="tax_class_id" class="form-select">
                <option value="">Seçiniz</option>
                @foreach($taxClasses as $taxClass)
                    <option value="{{ $taxClass->id }}">{{ $taxClass->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
</div> 