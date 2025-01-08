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

        <!-- Kategoriler -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Kategoriler</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <select name="categories[]" class="form-select" multiple data-tags="true">
                        @foreach($cat as $category)
                            <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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
        var categorySelect = document.querySelector('select[name="categories[]"]');
        new TomSelect(categorySelect, {
            plugins: ['remove_button'],
            maxItems: null
        });

        var tagSelect = document.querySelector('select[name="tags[]"]');
        new TomSelect(tagSelect, {
            plugins: ['remove_button'],
            maxItems: null,
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: async function(input) {
                const response = await $.post('/go/shop/tags/store', {
                    name: input,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                });
                return {
                    id: response.id,
                    name: response.name
                };
            }
        });
    });

    document.getElementById('tax_status').addEventListener('change', function() {
        const taxClassWrapper = document.getElementById('tax_class_wrapper');
        taxClassWrapper.style.display = this.value === 'none' ? 'none' : 'block';
    });

    // Sayfa yüklendiğinde kontrol et
    document.addEventListener('DOMContentLoaded', function() {
        const taxStatus = document.getElementById('tax_status');
        const taxClassWrapper = document.getElementById('tax_class_wrapper');
        taxClassWrapper.style.display = taxStatus.value === 'none' ? 'none' : 'block';
    });
</script>

@include('backend.layout.ck')
@endpush


