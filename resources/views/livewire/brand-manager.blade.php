<div class="card mt-3">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h3 class="card-title"><x-dashboard.icon.category/> Marka</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <select wire:model.defer="selectedBrandId" name="brand_id" class="form-select">
                <option value="">Marka Seçiniz</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($showAddBrand)
        <div class="input-group">
            <input type="text" 
                   wire:model="newBrandName" 
                   wire:keydown.enter.prevent="createBrand"
                   class="form-control" 
                   placeholder="Yeni Marka Adı">
            <button type="button" 
                    class="btn btn-primary" 
                    wire:click.prevent="createBrand" 
                    wire:loading.attr="disabled">
                <span wire:loading.remove>Ekle</span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status"></span>
                </span>
            </button>
        </div>
        @error('newBrandName') 
            <div class="text-danger mt-1"><x-dashboard.icon.alert-triangle/> {{ $message }}</div>
        @enderror
        @endif
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('brandCreated', (event) => {
                event.preventDefault();
                const select = document.querySelector('select[name="brand_id"]');
                if (select) {
                    select.value = event.brandId;
                    @this.$wire.set('selectedBrandId', event.brandId);
                }
            });
        });
    </script>
</div> 