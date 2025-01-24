<div class="mt-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Varyasyonlar</h3>
        </div>
        <div class="card-body">
            <!-- Özellik Seçimi -->
            <div class="mb-4">
                <label class="form-label fw-bold">Kullanılacak Özellikler</label>
                <div class="vstack gap-3">
                    @foreach($selectedAttributes as $index => $attribute)
                        <div class="card card-sm border">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1">
                                        <select class="form-select" wire:model="selectedAttributes.{{ $index }}.id" wire:change="loadAttributeValues({{ $index }})">
                                            <option value="">Özellik Seçin</option>
                                            @foreach($productAttributes as $attr)
                                                <option value="{{ $attr['id'] }}">{{ $attr['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-icon btn-danger" wire:click="removeAttribute({{ $index }})">
                                        <x-dashboard.icon.delete/>
                                    </button>
                                </div>

                                @if(!empty($attribute['values']))
                                    <div class="mt-3">
                                        <div class="btn-group w-100">
                                            @foreach($attribute['values'] as $value)
                                                <label class="btn {{ in_array($value['id'], $attribute['selected']) ? 'btn-soft-success text-success' : 'btn-outline-primary' }}">
                                                    <input type="checkbox" 
                                                           class="btn-check" 
                                                           wire:model="selectedAttributes.{{ $index }}.selected" 
                                                           value="{{ $value['id'] }}"
                                                           wire:change="generateVariations">
                                                    <span>{{ $value['name'] }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if(count($selectedAttributes) < count($productAttributes))
                        <button type="button" class="btn btn-primary" wire:click="addAttribute">
                            <x-dashboard.icon.add/> Özellik Ekle
                        </button>
                    @endif
                </div>
            </div>

            <!-- Varyasyon Tablosu -->
            @if(count($variations))
                @include('livewire.partials.variation-table')
            @endif
        </div>
    </div>
</div> 