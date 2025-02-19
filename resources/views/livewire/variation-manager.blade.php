<div class="variable-product-fields" style="display: {{ $show ? 'block' : 'none' }}">
    <div class="card mt-3">
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
                                        <select class="form-select" wire:model.live="selectedAttributes.{{ $index }}.id" wire:change="loadAttributeValues({{ $index }})">
                                            <option value="">Özellik Seçin</option>
                                            @foreach($productAttributes as $attr)
                                                <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-icon btn-danger" wire:click="removeAttribute({{ $index }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    </button>
                                </div>

                                @if(!empty($attribute['values']))
                                    <div class="mt-3">
                                        <label class="form-label">Değerler</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($attribute['values'] as $value)
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" 
                                                           type="checkbox"
                                                           wire:model.live="selectedAttributes.{{ $index }}.selected" 
                                                           value="{{ $value->id }}">
                                                    <span class="form-check-label">{{ $value->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-primary" wire:click="addAttribute">
                        Özellik Ekle
                    </button>
                </div>
            </div>

            @if(count($variations))
                @include('livewire.partials.variation-table')
            @endif
        </div>
    </div>
</div> 