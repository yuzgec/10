@extends('backend.layout.app')

@section('content')

{!! html()
    ->model($product)
    ->form('PUT', route('product.update.simple', $product->id))
    ->attribute('enctype', 'multipart/form-data')
    ->attribute('data-action', 'update')
    ->open() 
!!}
<input type="hidden" name="type" value="simple">
<input type="hidden" name="product_id" value="{{ $product->id }}">

<x-dashboard.crud.edit-header :model='$product' route="page" name="Ürün"/>

<div class="row">
    <div class="col-md-9 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <x-dashboard.crud.tab-menu :language='$language'>
                    <li class="nav-item" role="presentation">
                        <a href="#properties" class="nav-link" data-bs-toggle="tab">
                            <span  style="margin-left:10px"><x-dashboard.icon.star/> Özellikler</span>
                        </a>
                    </li>
                </x-dashboard.crud.tab-menu>
            </div>
            
            <div class="card-body">

                @foreach($language as $lang)
                <div class="tab-content">
                    <div class="tab-pane @if ($loop->first) active show @endif" id="{{$lang->lang}}" role="tabpanel">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-body">
                                <x-dashboard.form.input label='Ürün Adı' name='name:{{ $lang->lang }}' placeholder="Ürün Adı Giriniz ({{ $lang->native }})" maxlength="40" required="true" />
                                <x-dashboard.form.text-area label='Kısa Açıklama' name='short:{{ $lang->lang }}'/>
                                <x-dashboard.form.text-area label='Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
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
                <div class="tab-content">
                    <div class="tab-pane" id="properties" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <livewire:product-attribute-manager :product="$product" />
                            </div>
                
                            <div class="col-md-6 mb-3">
                                <livewire:tag-manager type="product" :model="$product" />
                            </div>
                
                            <div class="col-md-6 mb-3">
                                <livewire:brand-manager :selected-id="$product->brand_id" />
                            </div>
                
                            <div class="col-md-6 mb-3">
                                <livewire:tax-manager :product="$product" />
                            </div>
                
                            <div class="col-md-6 mb-3">
                                <livewire:product-dimension-manager :product="$product" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    
    </div>

    <div class="col-md-3">
        <!-- Sağ Sidebar -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>

            <div class="card-header">
                <h3 class="card-title">Ürün Detayları</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <x-dashboard.form.only-input name="sku" label="SKU" required="true" />
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="price" label="Fiyat" required="true" />
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="discount_price" label="İndirimli Fiyat" />
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="stock" label="Stok" required="true" />
                </div>

                <div class="mb-3">
                    <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="featured" value="1" 
                                {{ old('featured', $product->featured) ? 'checked' : '' }}>
                        <span class="form-check-label">Öne Çıkan Ürün</span>
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="status" value="1" 
                                {{ old('status', $product->status) ? 'checked' : '' }}>
                        <span class="form-check-label">Aktif</span>
                    </label>
                </div>

            </div>
        </div>

        <!-- Kategoriler -->
        <div class="card mb-3">
            <livewire:category-manager :product="$product" />
        </div>

        <!-- İlişkili Ürünler -->
        <livewire:relation-product :product="$product" />

        <!-- Stok Yönetimi -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Stok Yönetimi</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="manage_stock" value="1" 
                                {{ old('manage_stock', $product->manage_stock) ? 'checked' : '' }}>
                        <span class="form-check-label">Stok Takibi</span>
                    </label>
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="min_stock_level" label="Minimum Stok Seviyesi" value="{{ old('min_stock_level', $product->min_stock_level) }}" />
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="max_stock_level" label="Maksimum Stok Seviyesi" value="{{ old('max_stock_level', $product->max_stock_level) }}" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok Durumu</label>
                    <select name="stock_status" class="form-select">
                        <option value="in_stock" {{ old('stock_status', $product->stock_status) == 'in_stock' ? 'selected' : '' }}>Stokta</option>
                        <option value="out_of_stock" {{ old('stock_status', $product->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Stokta Yok</option>
                        <option value="on_backorder" {{ old('stock_status', $product->stock_status) == 'on_backorder' ? 'selected' : '' }}>Ön Siparişte</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Özel Alanlar -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Özel Alanlar</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="warranty_period" label="Garanti Süresi (Ay)" value="{{ old('warranty_period', $product->warranty_period) }}" />
                </div>
                <div class="mb-3">
                    <x-dashboard.form.only-input name="manufacturing_place" label="Üretim Yeri" value="{{ old('manufacturing_place', $product->manufacturing_place) }}" />
                </div>
                <div class="mb-3">
                    <x-dashboard.form.only-input name="barcode" label="Barkod" value="{{ old('barcode', $product->barcode) }}" />
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary w-100">
                Ürünü Kaydet
            </button>
        </div>
    </div>
</div>
{!! html()->form()->close() !!}
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // İlişkili ürünler için TomSelect
    const relatedProductsSelect = document.querySelector('#relatedProducts');
    if (relatedProductsSelect) {
        new TomSelect(relatedProductsSelect, {
            maxItems: null,
            placeholder: 'İlişkili ürünleri seçin...',
            allowEmptyOption: true
        });
    }

    // Etiketler için TomSelect
    const tagSelect = document.querySelector('select[name="tags[]"]');
    if (tagSelect) {
        new TomSelect(tagSelect, {
            maxItems: null,
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            placeholder: 'Etiket seçin veya ekleyin...',
            create: async function(input) {
                const response = await fetch('/go/shop/tags/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ name: input })
                });
                const data = await response.json();
                return {
                    id: data.id,
                    name: data.name
                };
            }
        });
    }
});
</script>

@include('backend.layout.ck')
@endpush


