@extends('backend.layout.app')

@section('content')
{!! html()->model($product)->form('PUT', route('product.updateVariable', $product->id))
->attribute('enctype', 'multipart/form-data')
->attribute('data-action', 'update')
->open() 
!!}

<div class="row">
    <div class="col-md-9">
        <!-- Ana Ürün Bilgileri -->     
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <x-dashboard.crud.tab-menu :language='$language'></x-dashboard.crud.tab-menu>
            </div>
            
            <div class="card-body">
                @foreach($language as $lang)
                <div class="tab-content">
                    <div class="tab-pane @if ($loop->first) active show @endif" id="{{$lang->lang}}" role="tabpanel">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-body">
                                <x-dashboard.form.input 
                                    required="true" 
                                    label='Ürün Adı' 
                                    name='name:{{ $lang->lang }}'
                                    placeholder="Ürün Adı Giriniz ({{ $lang->native }})" 
                                    maxlength="40"/>
                                <x-dashboard.form.text-area 
                                    label='Kısa Açıklama' 
                                    name='short:{{ $lang->lang }}'/>
                                <x-dashboard.form.text-area 
                                    label='Açıklama' 
                                    name='desc:{{ $lang->lang }}' 
                                    id='desc'/>
                            </div>
                        </div>

                        <x-dashboard.site.seo :lang="$lang" />
                    </div>       
                </div>
                @endforeach

                <div class="tab-content">
                    <div class="tab-pane" id="image" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-blue">
                                            <x-dashboard.icon.image/>
                                        </div>
                                    </div>
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.image/>Image</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="image-preview-container">
                                            <input 
                                                type="file" 
                                                class="image-preview-input" 
                                                name="image" 
                                                id="pageImageInput"
                                                data-preview-target="pageImagePreview"
                                                accept="image/*"
                                            >
                                            <img 
                                                src="/backend/resimyok.jpg" 
                                                id="pageImagePreview"
                                                class="preview-image mb-2"
                                                alt="Preview"
                                            >
                                            <div class="upload-button">
                                                <x-dashboard.icon.add-image width="12"/>
                                                <p class="text-muted">Resim yüklemek için tıklayın veya sürükleyin</p>
                                                <small class="text-muted">PNG, JPG veya JPEG</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-green">
                                            <x-dashboard.icon.image/>
                                        </div>
                                    </div>
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.image/>Cover</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="image-preview-container">
                                            <input 
                                                type="file" 
                                                class="image-preview-input" 
                                                name="cover" 
                                                id="coverInput"
                                                data-preview-target="coverPreview"
                                                accept="image/*"
                                            >
                                            <img 
                                                src="/backend/resimyok.jpg" 
                                                id="coverPreview" 
                                                class="preview-image mb-2"
                                                alt="Cover"
                                            >
                                            <div class="upload-button">
                                                <x-dashboard.icon.add-image/>
                                                <p class="text-muted">Cover resmi yüklemek için tıklayın veya sürükleyin</p>
                                                <small class="text-muted">PNG, JPG veya JPEG</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-purple">
                                            <x-dashboard.icon.gallery/>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.gallery/>Foto Galeri</h4>
                                    </div>
                                    <div class="card-body">
                                        <input class="form-control" type="file" name="gallery[]" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Varyasyon Yönetimi -->
        <livewire:variation-manager :product="$product" />

        <!-- Marka Yönetimi -->
        <div class="card mt-3">
            <div class="card-body">
                <livewire:brand-manager :selected-id="$product->brand_id ?? null" />
            </div>
        </div>

        <!-- Etiket Yönetimi -->
        <div class="card mt-3">
            <div class="card-body">
                <livewire:tag-manager type="product" :model="$product" />
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Seçin</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Durum</label>
                    <select name="status" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


{!! html()->form()->close() !!}
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

@push('scripts')
<script>
    function productForm(attributes, existingVariations) {
        return {
            attributes: attributes,
            selectedAttributes: [],
            variations: existingVariations || [],
            bulkPrice: '',
            skuPrefix: '',
            
            // Toplu fiyat uygulama
            applyBulkPrice() {
                if (!this.bulkPrice) return;
                this.variations.forEach(v => v.price = this.bulkPrice);
                this.generateVariationTable();
            },
            
            // SKU oluşturucu
            generateSKUs() {
                const prefix = this.skuPrefix.trim().toUpperCase();
                
                this.variations.forEach((variation, index) => {
                    // Her kelimeyi ayır ve baş harflerini al
                    const skuCode = variation.values
                        .map(v => v.name.charAt(0).toUpperCase())
                        .join('');

                    const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                    
                    // Prefix varsa ekle
                    variation.sku = prefix 
                        ? `${prefix}-${skuCode}-${random}`
                        : `${skuCode}-${random}`;
                });
                
                this.generateVariationTable();
            },

            // Kartezyen çarpım fonksiyonu ekle
            cartesianProduct(obj) {
                const keys = Object.keys(obj);
                const values = keys.map(key => obj[key]);
                const combinations = [];
                
                function generate(arr, i, result = {}) {
                    if (i === values.length) {
                        combinations.push({...result});
                        return;
                    }
                    
                    for (let j = 0; j < values[i].length; j++) {
                        result[keys[i]] = values[i][j];
                        generate(arr, i + 1, result);
                    }
                }
                
                generate(values, 0);
                return combinations;
            },

            init() {
                if (this.variations && this.variations.length > 0) {
                    // Benzersiz özellikleri bul
                    const uniqueAttributes = new Map();
                    
                    this.variations.forEach(variation => {
                        variation.values.forEach(value => {
                            if (!uniqueAttributes.has(value.attribute_id)) {
                                const attribute = this.attributes.find(a => a.id === value.attribute_id);
                                if (attribute) {
                                    uniqueAttributes.set(value.attribute_id, {
                                        id: value.attribute_id,
                                        values: attribute.values,
                                        selected: new Set()
                                    });
                                }
                            }
                            uniqueAttributes.get(value.attribute_id).selected.add(value.value_id);
                        });
                    });

                    // selectedAttributes'i güncelle
                    this.selectedAttributes = Array.from(uniqueAttributes.values()).map(attr => ({
                        id: attr.id,
                        values: this.attributes.find(a => a.id === attr.id).values,
                        selected: Array.from(attr.selected)
                    }));
                }
                
                this.generateVariationTable();
            },

            addAttribute() {
                if (this.selectedAttributes.length < this.attributes.length) {
                    this.selectedAttributes.push({
                        id: '',
                        values: [],
                        selected: []
                    });
                }
            },

            // Renk özelliği kontrolü
            isColorAttribute(attributeId) {
                const attribute = this.attributes.find(a => a.id === attributeId);
                return attribute && attribute.type === 'color';
            },

            // Özellik değerlerini yükle - Güncellendi
            async loadAttributeValues(index) {
                const attribute = this.selectedAttributes[index];
                if (!attribute.id) {
                    attribute.values = [];
                    return; // selected dizisini sıfırlama
                }

                const attr = this.attributes.find(a => a.id == attribute.id);
                if (attr) {
                    attribute.values = attr.values;
                    // Eğer selected dizisi boşsa, varsayılan değerleri koru
                    if (!attribute.selected) {
                        attribute.selected = [];
                    }
                }
            },

            // Özellik kaldır
            removeAttribute(index) {
                this.selectedAttributes.splice(index, 1);
                this.generateVariations();
            },

            // Varyasyon oluştur - Güncellendi
            generateVariations() {
                // Seçili değerleri kontrol et
                const hasSelectedValues = this.selectedAttributes.some(attr => attr.selected && attr.selected.length > 0);
                if (!hasSelectedValues) return;

                // Her özellik için seçili değerleri al
                const selectedValues = this.selectedAttributes.reduce((acc, attr) => {
                    if (attr.selected && attr.selected.length > 0) {
                        acc[attr.id] = attr.selected;
                    }
                    return acc;
                }, {});

                // Kartezyen çarpım ile tüm kombinasyonları oluştur
                const combinations = this.cartesianProduct(selectedValues);

                // Mevcut varyasyonları koru
                const existingVariations = new Map(
                    this.variations.map(v => [
                        this.getVariationKey(v.values),
                        v
                    ])
                );

                // Varyasyonları güncelle
                this.variations = combinations.map(combination => {
                    const values = Object.entries(combination).map(([attrId, valueId]) => {
                        const attribute = this.attributes.find(a => a.id == attrId);
                        const value = attribute.values.find(v => v.id == valueId);
                        return {
                            attribute_id: parseInt(attrId),
                            value_id: valueId,
                            name: value.name
                        };
                    });

                    const key = this.getVariationKey(values);
                    const existing = existingVariations.get(key);

                    return existing || {
                        values,
                        name: values.map(v => v.name).join(' / '),
                        price: '',
                        stock: 0,
                        sku: ''
                    };
                });

                this.generateVariationTable();
            },

            // Varyasyon anahtarı oluştur
            getVariationKey(values) {
                return values
                    .map(v => `${v.attribute_id}-${v.value_id}`)
                    .sort()
                    .join('|');
            },

            generateVariationTable() {
                const table = document.createElement('table');
                table.className = 'table table-vcenter table-bordered mt-3';
                
                // Başlık satırı
                const thead = table.createTHead();
                const headerRow = thead.insertRow();
                headerRow.innerHTML = `
                    <th>Varyasyon</th>
                    <th>SKU</th>
                    <th>Fiyat</th>
                    <th>Stok</th>
                    <th>Varsayılan</th>
                `;

                // Varyasyonları ekle
                const tbody = table.createTBody();
                this.variations.forEach(variation => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${variation.values.map(v => v.name).join(' / ')}</td>
                        <td>
                            <input type="text" class="form-control" name="variations[${variation.id}][sku]" value="${variation.sku}">
                        </td>
                        <td>
                            <input type="number" step="0.01" class="form-control" name="variations[${variation.id}][price]" value="${variation.price}">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="variations[${variation.id}][stock]" value="${variation.stock}">
                        </td>
                        <td class="text-center">
                            <input type="radio" class="form-check-input" name="default_variation" value="${variation.id}" ${variation.is_default ? 'checked' : ''}>
                        </td>
                    `;
                });

                // Tabloyu sayfaya ekle
                const container = document.querySelector('#variation-table-container');
                container.innerHTML = '';
                container.appendChild(table);
            }
        }
    }
</script>
@endpush
@include('backend.layout.ck')
@endsection 