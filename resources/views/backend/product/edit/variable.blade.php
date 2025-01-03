@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Varyasyonlu Ürün Düzenle</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Sol Kolon -->
                            <div class="col-md-8">
                                <!-- Dil Sekmeleri -->
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                            @foreach(config('app.locales') as $locale)
                                                <li class="nav-item">
                                                    <a href="#{{ $locale }}" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">
                                                        {{ strtoupper($locale) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            @foreach(config('app.locales') as $locale)
                                                <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="{{ $locale }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ürün Adı ({{ strtoupper($locale) }})</label>
                                                        <input type="text" name="name:{{ $locale }}" class="form-control @error("name:$locale") is-invalid @enderror" 
                                                               value="{{ old("name:$locale", $product->translate($locale)->name ?? '') }}">
                                                        @error("name:$locale")
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Kısa Açıklama ({{ strtoupper($locale) }})</label>
                                                        <textarea name="short:{{ $locale }}" rows="3" class="form-control @error("short:$locale") is-invalid @enderror">{{ old("short:$locale", $product->translate($locale)->short ?? '') }}</textarea>
                                                        @error("short:$locale")
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Detaylı Açıklama ({{ strtoupper($locale) }})</label>
                                                        <textarea name="desc:{{ $locale }}" class="editor form-control @error("desc:$locale") is-invalid @enderror">{{ old("desc:$locale", $product->translate($locale)->desc ?? '') }}</textarea>
                                                        @error("desc:$locale")
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Varyasyonlar -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Varyasyonlar</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- Özellik Seçimi -->
                                        <div class="mb-3">
                                            <label class="form-label">Varyasyon Özellikleri</label>
                                            <select id="attributes" class="form-select" multiple>
                                                @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}" 
                                                            {{ in_array($attribute->id, $product->variations->pluck('attributes.*.attribute_id')->flatten()->unique()->toArray()) ? 'selected' : '' }}>
                                                        {{ $attribute->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Varyasyon Listesi -->
                                        <div id="variations-container">
                                            @foreach($product->variations as $variation)
                                                <div class="card mb-3 variation-item">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="variations[{{ $loop->index }}][id]" value="{{ $variation->id }}">
                                                                
                                                                @foreach($variation->attributes as $attr)
                                                                    <input type="hidden" 
                                                                           name="variations[{{ $loop->parent->index }}][attributes][{{ $loop->index }}][attribute_id]" 
                                                                           value="{{ $attr->attribute_id }}">
                                                                    <input type="hidden" 
                                                                           name="variations[{{ $loop->parent->index }}][attributes][{{ $loop->index }}][value_id]" 
                                                                           value="{{ $attr->value_id }}">
                                                                @endforeach

                                                                <div class="mb-3">
                                                                    <label class="form-label">SKU</label>
                                                                    <input type="text" class="form-control" 
                                                                           name="variations[{{ $loop->index }}][sku]" 
                                                                           value="{{ $variation->sku }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Fiyat</label>
                                                                    <input type="number" step="0.01" class="form-control" 
                                                                           name="variations[{{ $loop->index }}][price]" 
                                                                           value="{{ $variation->price }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Stok</label>
                                                                    <input type="number" class="form-control" 
                                                                           name="variations[{{ $loop->index }}][stock]" 
                                                                           value="{{ $variation->stock }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Durum</label>
                                                                    <select class="form-select" name="variations[{{ $loop->index }}][status]">
                                                                        <option value="1" {{ $variation->status ? 'selected' : '' }}>Aktif</option>
                                                                        <option value="0" {{ !$variation->status ? 'selected' : '' }}>Pasif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sağ Kolon -->
                            <div class="col-md-4">
                                <!-- Durum -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1" 
                                                       {{ old('status', $product->status) ? 'checked' : '' }}>
                                                <span class="form-check-label">Aktif</span>
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" name="featured" value="1" 
                                                       {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                                <span class="form-check-label">Öne Çıkan</span>
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
                                                        {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $category->translate(app()->getLocale())->name }}
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
                                                <option value="{{ $tag->name }}" 
                                                        {{ in_array($tag->name, old('tags', $product->tags->pluck('name')->toArray())) ? 'selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Resim -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Ürün Görseli</h3>
                                    </div>
                                    <div class="card-body">
                                        @if($product->hasMedia('image'))
                                            <div class="mb-3">
                                                <img src="{{ $product->getFirstMediaUrl('image', 'thumb') }}" class="img-fluid">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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

        var attributeSelect = document.querySelector('#attributes');
        new TomSelect(attributeSelect, {
            plugins: ['remove_button'],
            maxItems: null,
            onChange: function(values) {
                generateVariations(values);
            }
        });
    });

    // CKEditor için
    document.querySelectorAll('.editor').forEach(function(element) {
        ClassicEditor
            .create(element)
            .catch(error => {
                console.error(error);
            });
    });

    // Varyasyon oluşturma
    function generateVariations(attributeIds) {
        // Burada varyasyon kombinasyonlarını oluşturan JavaScript kodu olacak
    }
</script>
@endpush 


@section('customJS')
    @include('backend.layout.ck')
@endsection