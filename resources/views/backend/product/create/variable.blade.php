@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <form action="{{ route('product.store.variable') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Ana Ürün Bilgileri -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Yeni Varyantlı Ürün</h3>
                    </div>
                    <div class="card-body">
                        <!-- Medya Alanı -->
                        <div class="mb-3">
                            <label class="form-label required">Ürün Görseli</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   name="image" accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Galeri</label>
                            <input type="file" class="form-control @error('gallery.*') is-invalid @enderror" 
                                   name="gallery[]" multiple accept="image/*">
                            @error('gallery.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dil Sekmeleri -->
                        <div class="mb-3">
                            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                                @foreach(config('app.locales') as $locale)
                                <li class="nav-item">
                                    <a href="#{{ $locale }}" class="nav-link @if($loop->first) active @endif" 
                                       data-bs-toggle="tab">
                                        {{ strtoupper($locale) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach(config('app.locales') as $locale)
                                <div class="tab-pane @if($loop->first) active show @endif" id="{{ $locale }}">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label required">Ürün Adı ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control @error('name:'.$locale) is-invalid @enderror" 
                                               name="name:{{ $locale }}" 
                                               value="{{ old('name:'.$locale) }}" required>
                                        @error('name:'.$locale)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kısa Açıklama ({{ strtoupper($locale) }})</label>
                                        <textarea class="form-control @error('short:'.$locale) is-invalid @enderror" 
                                                  name="short:{{ $locale }}" 
                                                  rows="3">{{ old('short:'.$locale) }}</textarea>
                                        @error('short:'.$locale)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Detaylı Açıklama ({{ strtoupper($locale) }})</label>
                                        <textarea class="form-control editor @error('desc:'.$locale) is-invalid @enderror" 
                                                  name="desc:{{ $locale }}" 
                                                  rows="6">{{ old('desc:'.$locale) }}</textarea>
                                        @error('desc:'.$locale)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Varyant Yönetimi -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Varyantlar</h3>
                    </div>
                    <div class="card-body">
                        <!-- Özellik Seçimi -->
                        <div class="mb-3">
                            <label class="form-label">Kullanılacak Özellikler</label>
                            <select id="attribute-select" class="form-select" multiple>
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}" data-values='@json($attribute->values)'>
                                        {{ $attribute->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Varyant Listesi -->
                        <div id="variants-container">
                            <!-- JavaScript ile doldurulacak -->
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-success" id="generate-variants">
                                Varyantları Oluştur
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Sağ Sidebar -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Ürün Detayları</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="featured" value="1" 
                                       {{ old('featured') ? 'checked' : '' }}>
                                <span class="form-check-label">Öne Çıkan Ürün</span>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="status" value="1" 
                                       {{ old('status', 1) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Kategoriler -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Kategoriler</h3>
                    </div>
                    <div class="card-body">
                        <select name="categories[]" class="form-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Etiketler -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Etiketler</h3>
                    </div>
                    <div class="card-body">
                        <select name="tags[]" class="form-select" multiple data-tags="true">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" 
                                        {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">
                        Ürünü Kaydet
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Varyant Template -->
<template id="variant-template">
    <div class="variant-item card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label required">Varyant Adı</label>
                    <input type="text" class="form-control" name="variants[INDEX][name]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">SKU</label>
                    <input type="text" class="form-control" name="variants[INDEX][sku]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Fiyat</label>
                    <input type="number" step="0.01" class="form-control" name="variants[INDEX][price]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">İndirimli Fiyat</label>
                    <input type="number" step="0.01" class="form-control" name="variants[INDEX][discount_price]">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Stok</label>
                    <input type="number" class="form-control" name="variants[INDEX][stock]" required>
                </div>
                <div class="attribute-fields">
                    <!-- JavaScript ile doldurulacak -->
                </div>
            </div>
        </div>
    </div>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // TomSelect Initializasyonu
    const attributeSelect = new TomSelect('#attribute-select', {
        plugins: ['remove_button'],
        maxItems: null,
        onChange: function() {
            updateVariantForm();
        }
    });

    new TomSelect('select[name="categories[]"]', {
        plugins: ['remove_button'],
        maxItems: null
    });

    new TomSelect('select[name="tags[]"]', {
        plugins: ['remove_button'],
        maxItems: null,
        create: true
    });

    // CKEditor
    document.querySelectorAll('.editor').forEach(function(element) {
        ClassicEditor
            .create(element)
            .catch(error => {
                console.error(error);
            });
    });

    // Varyant Yönetimi
    let variantIndex = 0;
    const variantsContainer = document.getElementById('variants-container');
    const variantTemplate = document.getElementById('variant-template');

    document.getElementById('generate-variants').addEventListener('click', function() {
        const selectedAttributes = attributeSelect.getValue();
        if (selectedAttributes.length === 0) {
            alert('Lütfen en az bir özellik seçin');
            return;
        }

        generateVariantCombinations(selectedAttributes);
    });

    function generateVariantCombinations(attributes) {
        // Seçilen özelliklerin değerlerini al
        const attributeValues = attributes.map(attrId => {
            const attr = attributeSelect.options[attrId];
            return {
                id: attrId,
                name: attr.text,
                values: attr.dataset.values ? JSON.parse(attr.dataset.values) : []
            };
        });

        // Tüm kombinasyonları oluştur
        const combinations = getCombinations(attributeValues);
        
        // Her kombinasyon için bir varyant formu oluştur
        combinations.forEach(combination => {
            addVariantForm(combination, attributeValues);
        });
    }

    function getCombinations(attributes) {
        const result = [[]];
        
        attributes.forEach(attribute => {
            const temp = [];
            result.forEach(current => {
                attribute.values.forEach(value => {
                    temp.push([...current, { 
                        attributeId: attribute.id,
                        valueId: value.id,
                        valueName: value.value 
                    }]);
                });
            });
            result.length = 0;
            result.push(...temp);
        });
        
        return result;
    }

    function addVariantForm(combination, attributes) {
        const variantDiv = variantTemplate.content.cloneNode(true).querySelector('.variant-item');
        
        // Varyant adını oluştur
        const variantName = combination.map(item => item.valueName).join(' / ');
        variantDiv.querySelector('input[name$="[name]"]').value = variantName;
        
        // Index'leri güncelle
        variantDiv.innerHTML = variantDiv.innerHTML.replace(/INDEX/g, variantIndex);
        
        // Özellik alanlarını ekle
        const attributeFields = variantDiv.querySelector('.attribute-fields');
        combination.forEach(item => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `variants[${variantIndex}][attributes][${item.attributeId}]`;
            input.value = item.valueId;
            attributeFields.appendChild(input);
        });
        
        variantsContainer.appendChild(variantDiv);
        variantIndex++;
    }
});
</script>
@endpush 