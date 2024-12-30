@extends('backend.layout.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Ürün Ekle</h3>
        </div>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    {{-- Dil Sekmeleri --}}
                    <div class="col-12">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item">
                                    <a href="#{{ $localeCode }}" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">
                                        <img src="/flags/{{ $localeCode }}.svg" width="20"> {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Dil İçerikleri --}}
                    <div class="col-12 mt-3">
                        <div class="tab-content">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="{{ $localeCode }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Ürün Adı ({{ $localeCode }})</label>
                                                <input type="text" class="form-control" name="{{ $localeCode }}[name]" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kısa Açıklama ({{ $localeCode }})</label>
                                                <textarea class="form-control" name="{{ $localeCode }}[short]" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Detaylı Açıklama ({{ $localeCode }})</label>
                                                <textarea class="editor" name="{{ $localeCode }}[desc]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Genel Bilgiler --}}
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ürün Detayları</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select name="category_id" class="form-select">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Marka</label>
                                            <select name="brand_id" class="form-select">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Durum</label>
                                            <select name="status" class="form-select">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Varyant Seçimi --}}
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Varyantlar</h4>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="hasVariants">
                                    <span class="form-check-label">Varyantlı Ürün</span>
                                </label>
                            </div>
                            
                            {{-- Basit Ürün Bilgileri --}}
                            <div id="simpleProduct" class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Fiyat</label>
                                            <input type="number" step="0.01" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Stok</label>
                                            <input type="number" class="form-control" name="stock">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">SKU</label>
                                            <input type="text" class="form-control" name="sku">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Varyant Bilgileri --}}
                            <div id="variantProduct" class="card-body" style="display: none;">
                                <div class="variant-list">
                                    <div class="variant-item mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Varyant Adı</label>
                                                    <input type="text" class="form-control" name="variants[0][name]">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Fiyat</label>
                                                    <input type="number" step="0.01" class="form-control" name="variants[0][price]">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Stok</label>
                                                    <input type="number" class="form-control" name="variants[0][stock]">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" class="form-control" name="variants[0][sku]">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Resimler</label>
                                                    <input type="file" class="form-control" name="variants[0][images][]" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="addVariant">
                                    Yeni Varyant Ekle
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Ürün Resimleri --}}
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ürün Resimleri</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ana Resim</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kapak Resmi</label>
                                            <input type="file" class="form-control" name="cover">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Galeri</label>
                                            <input type="file" class="form-control" name="gallery[]" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hasVariants = document.getElementById('hasVariants');
    const simpleProduct = document.getElementById('simpleProduct');
    const variantProduct = document.getElementById('variantProduct');
    const addVariantBtn = document.getElementById('addVariant');
    let variantCount = 1;

    // Varyant switch kontrolü
    hasVariants.addEventListener('change', function() {
        simpleProduct.style.display = this.checked ? 'none' : 'block';
        variantProduct.style.display = this.checked ? 'block' : 'none';
    });

    // Yeni varyant ekleme
    addVariantBtn.addEventListener('click', function() {
        const variantList = document.querySelector('.variant-list');
        const newVariant = document.querySelector('.variant-item').cloneNode(true);
        
        // Input isimlerini güncelle
        newVariant.querySelectorAll('input').forEach(input => {
            input.name = input.name.replace('[0]', `[${variantCount}]`);
            input.value = '';
        });

        variantList.appendChild(newVariant);
        variantCount++;
    });
});
</script>
@endpush
@foreach($language as $lang)
<script type="text/javascript">
    CKEDITOR.replace( 'desc:{{ $lang->lang }}', {
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserUploadMethod: 'form',
        allowedContent: true,
        height : 400,
        

    });
</script>
@endforeach
@endsection