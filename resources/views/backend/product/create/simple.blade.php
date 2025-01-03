@extends('backend.layout.app')

@section('content')
{!! html()->form()
    ->method('POST')
    ->action(route('product.store.variable'))
    ->attribute('enctype', 'multipart/form-data')
    ->open()
!!}
<x-dashboard.crud.create-header route='product' name="Ürün"/>

<div class="row">
    <div class="col-md-9 mb-3">
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
                                <x-dashboard.form.input label='Sayfa Adı' name='name:{{ $lang->lang }}' placeholder="Sayfa Adı Giriniz ({{ $lang->native }})" maxlength="40"/>
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
                    <label class="form-label required">SKU</label>
                    <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                            name="sku" value="{{ old('sku') }}" required>
                    @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required">Fiyat</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                            name="price" value="{{ old('price') }}" required>
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">İndirimli Fiyat</label>
                    <input type="number" step="0.01" class="form-control @error('discount_price') is-invalid @enderror" 
                            name="discount_price" value="{{ old('discount_price') }}">
                    @error('discount_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required">Stok</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                            name="stock" value="{{ old('stock') }}" required>
                    @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Etiketler -->
        <livewire:tag-manager type="product" />

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
    // TomSelect için
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
            create: true
        });
    });

</script>
@endpush 


@section('customJS')
    @include('backend.layout.ck')
@endsection