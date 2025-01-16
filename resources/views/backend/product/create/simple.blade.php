@extends('backend.layout.app')

@section('content')

{!! html()->form()
    ->method('POST')
    ->action(route('product.store.simple'))
    ->attribute('enctype', 'multipart/form-data')
    ->attribute('data-action', 'create')
    ->open()
!!}
<x-dashboard.crud.create-header route='product' name="Ürün"/>

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
                <div class="tab-content">
                    <div class="tab-pane" id="properties" role="tabpanel">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <livewire:product-attribute-manager />
                            </div>

                            <div class="col-md-6 mb-3">
                                <livewire:tag-manager type="product" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <livewire:brand-manager :selected-id="$brand->id ?? null" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <livewire:tax-manager />
                            </div>
                            <div class="col-md-6 mb-3">
                                <livewire:product-dimension-manager :product="$product ?? null" />
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

        <!-- Stok Yönetimi -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Stok Yönetimi</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="manage_stock" name="manage_stock" value="1">
                        <label class="form-check-label" for="manage_stock">Stok Takibi</label>
                    </div>
                </div>

                <div id="stockFields" style="display: none;">
                    <!-- Stok alanları -->
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Minimum Stok Seviyesi</label>
                                <input type="number" class="form-control" name="min_stock_level" value="{{ old('min_stock_level') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Maksimum Stok Seviyesi</label>
                                <input type="number" class="form-control" name="max_stock_level" value="{{ old('max_stock_level') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok Durumu</label>
                        <select name="stock_status" class="form-select">
                            <option value="in_stock" {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>Stokta</option>
                            <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Stok Yok</option>
                            <option value="on_backorder" {{ old('stock_status') == 'on_backorder' ? 'selected' : '' }}>Ön Sipariş</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="allow_backorders" name="allow_backorders" value="1">
                            <label class="form-check-label" for="allow_backorders">Ön Siparişe İzin Ver</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="notify_low_stock" name="notify_low_stock" value="1">
                            <label class="form-check-label" for="notify_low_stock">Düşük Stok Bildirimi</label>
                        </div>
                    </div>

                    <div id="lowStockFields" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Düşük Stok Eşiği</label>
                            <input type="number" class="form-control" name="low_stock_threshold" value="{{ old('low_stock_threshold') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="show_stock_quantity" name="show_stock_quantity" value="1" checked>
                            <label class="form-check-label" for="show_stock_quantity">Stok Miktarını Göster</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="requires_shipping" name="requires_shipping" value="1">
                        <label class="form-check-label" for="requires_shipping">Kargo Gerekli</label>
                    </div>
                </div>

                <div id="shippingFields" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Teslimat Süresi (Gün)</label>
                        <input type="number" class="form-control" name="delivery_time" value="{{ old('delivery_time') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <x-dashboard.form.only-number-input name="shipping_cost" label="Kargo Ücreti" step="0.01" />
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
                    <x-dashboard.form.only-number-input name="warranty_period" label="Garanti Süresi (Ay)" />
                </div>
                <div class="mb-3">
                    <x-dashboard.form.only-input name="manufacturing_place" label="Üretim Yeri" />
                </div>
                <div class="mb-3">
                    <x-dashboard.form.only-input name="barcode" label="Barkod" />
                </div>
            </div>
        </div>

  

        <!-- Kategoriler -->
        <div class="card mb-3">
            <select name="categories[]" id="categories" class="form-select" multiple required>
                @foreach($cat as $category)
                    <option value="{{ $category->id }}">{{ $category->translate(app()->getLocale())->name }}</option>
                @endforeach
            </select>
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


@include('backend.layout.ck')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const manageStock = document.getElementById('manage_stock');
    const stockFields = document.getElementById('stockFields');
    const notifyLowStock = document.getElementById('notify_low_stock');
    const lowStockFields = document.getElementById('lowStockFields');
    const requiresShipping = document.getElementById('requires_shipping');
    const shippingFields = document.getElementById('shippingFields');

    manageStock.addEventListener('change', function() {
        stockFields.style.display = this.checked ? 'block' : 'none';
    });

    notifyLowStock.addEventListener('change', function() {
        lowStockFields.style.display = this.checked ? 'block' : 'none';
    });

    requiresShipping.addEventListener('change', function() {
        shippingFields.style.display = this.checked ? 'block' : 'none';
    });
});
</script>
@endpush


