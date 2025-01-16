<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kargo & Teslimat</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="requires_shipping" wire:model="requires_shipping">
                <label class="custom-control-label" for="requires_shipping">Kargo Gerekli</label>
            </div>
        </div>

        @if($requires_shipping)
            <div class="form-group">
                <label for="delivery_time">Teslimat Süresi (Gün)</label>
                <input type="number" class="form-control" id="delivery_time" wire:model="delivery_time" min="0">
                <small class="form-text text-muted">Tahmini teslimat süresini gün olarak belirtin.</small>
            </div>
        @endif

        <input type="hidden" name="requires_shipping" value="{{ $requires_shipping }}">
        <input type="hidden" name="delivery_time" value="{{ $delivery_time }}">
    </div>
</div> 