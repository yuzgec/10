<div class="card">
    <div class="card-header">
        <h3 class="card-title">Stok Yönetimi</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="manage_stock" wire:model="manage_stock">
                <label class="custom-control-label" for="manage_stock">Stok Takibi</label>
            </div>
        </div>

        @if($manage_stock)
            <div class="form-group">
                <label for="min_stock_level">Minimum Stok Seviyesi</label>
                <input type="number" class="form-control" id="min_stock_level" wire:model="min_stock_level" min="0">
            </div>

            <div class="form-group">
                <label for="stock_status">Stok Durumu</label>
                <select class="form-control" id="stock_status" wire:model="stock_status">
                    <option value="in_stock">Stokta</option>
                    <option value="out_of_stock">Stok yok</option>
                    <option value="on_backorder">Ön sipariş</option>
                </select>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="allow_backorders" wire:model="allow_backorders">
                    <label class="custom-control-label" for="allow_backorders">Ön Siparişe İzin Ver</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="notify_low_stock" wire:model="notify_low_stock">
                    <label class="custom-control-label" for="notify_low_stock">Düşük Stok Bildirimi</label>
                </div>
            </div>

            @if($notify_low_stock)
                <div class="form-group">
                    <label for="low_stock_threshold">Düşük Stok Eşiği</label>
                    <input type="number" class="form-control" id="low_stock_threshold" wire:model="low_stock_threshold" min="0">
                </div>
            @endif

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="show_stock_quantity" wire:model="show_stock_quantity">
                    <label class="custom-control-label" for="show_stock_quantity">Stok Miktarını Göster</label>
                </div>
            </div>
        @endif

        <input type="hidden" name="manage_stock" value="{{ $manage_stock }}">
        <input type="hidden" name="min_stock_level" value="{{ $min_stock_level }}">
        <input type="hidden" name="stock_status" value="{{ $stock_status }}">
        <input type="hidden" name="allow_backorders" value="{{ $allow_backorders }}">
        <input type="hidden" name="notify_low_stock" value="{{ $notify_low_stock }}">
        <input type="hidden" name="low_stock_threshold" value="{{ $low_stock_threshold }}">
        <input type="hidden" name="show_stock_quantity" value="{{ $show_stock_quantity }}">
    </div>
</div> 