<div>
    @foreach($selectedAttributes as $attributeId => $valueId)
        <input type="hidden" name="selectedAttributes[{{ $attributeId }}]" value="{{ $valueId }}">
    @endforeach
    
    <!-- Mevcut kartın içeriği -->
    <div class="card mb-3">
        <div class="card-status-top bg-blue"></div>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><x-dashboard.icon.star/> Ürün Özellikleri</h3>
            <div class="card-actions">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <x-dashboard.icon.add /> Ekle
                    </button>
                    <div class="dropdown-menu">
                        @foreach($attributes as $attribute)
                            <a class="dropdown-item" href="#" wire:click.prevent="addAttribute({{ $attribute->id }})">
                                {{ $attribute->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach($selectedAttributes as $attributeId => $valueId)
                @php
                    $attribute = $attributesList[$attributeId] ?? null;
                @endphp
                @if($attribute)
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label">{{ $attribute->name }}</label>
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-danger" wire:click="removeAttribute({{ $attributeId }})">
                            <x-dashboard.icon.delete />
                        </button>
                    </div>
                    <select class="form-select" wire:model="selectedAttributes.{{ $attributeId }}">
                        <option value="">Seçiniz</option>
                        @foreach($attribute->values as $value)
                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div> 