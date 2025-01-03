@extends('backend.layout.app')
@section('content')
{!! html()->model($product)->form('PUT', route('product.update', $product->id))
->attribute('enctype', 'multipart/form-data')
->attribute('data-action', 'update')
->open() 
!!}

<x-dashboard.crud.edit-header :model='$product' route="product" name="Ürün"/>

<div class="row">
    <div class="col-md-9 mb-3 p-1">
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
                            <div class="col-md-6 col-12 mb-3">
                                <div class="card">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-blue">
                                            <x-dashboard.icon.image/>
                                        </div>
                                    </div>
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.image/>Image <small style="color:gray">(İlk Fotoğraf)</small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            
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
                                                    src="{{ $product->getFirstMediaUrl('page','img') }}" 
                                                    id="pageImagePreview" 
                                                    class="preview-image"
                                                    alt="Preview"
                                                >
                                                    <button 
                                                        type="button" 
                                                        class="delete-media-btn" 
                                                        data-model-id="{{ $product->id ?? '' }}"
                                                        data-model-type="Page"
                                                        data-collection="page"
                                                        data-preview-target="imagePreview"
                                                        title="Resmi Kaldır"
                                                    >
                                                    <x-dashboard.icon.delete width="50"/>
                                                </button>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <div class="card">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-green">
                                            <x-dashboard.icon.image/>
                                        </div>
                                    </div>
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.image/>Cover <small style="color:gray">(Sayfa Üstüne Gelen Fotoğraf)</small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            
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
                                                src="{{ $product->getFirstMediaUrl('cover','img') }}" 
                                                id="coverPreview" 
                                                class="preview-image"
                                                alt="Cover"
                                                title="Resim seçmek için tıklayın"
                                            >
                                            <button 
                                                    type="button" 
                                                    class="delete-media-btn" 
                                                    data-model-id="{{ $product->id ?? '' }}"
                                                    data-model-type="Page"
                                                    data-collection="cover"
                                                    data-preview-target="coverPreview"
                                                    title="Resmi Kaldır">
                                                <x-dashboard.icon.delete/>
                                            </button>
                                        </div>
                                                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-12 mb-3">
                                <div class="card">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-purple">
                                            <x-dashboard.icon.gallery/>
                                        </div>
                                    </div>
                                    <div class="card-status-top bg-blue"></div>

                                    <div class="card-header">
                                        <h4 class="card-title"><x-dashboard.icon.gallery/>Foto Galeri
                                            <small style="color:gray">(Sayfa Altına Gelen Galeri)</small>
                                        </h4>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                        <input class="form-control mb-2" type="file" name="gallery[]" multiple>
                                        <div class="table-responsive ">
                                            <table class="table table-hover table-bordered table-center">
                                                <thead>
                                                <tr>
                                                    <th>Sıra</th>
                                                    <th>Resim</th>
                                                    <th>Boyut</th>
                                                    <th>Ad</th>
                                                    <th>Sil</th>
                                                </tr>
                                                </thead>
                                                <tbody id="sortable-gallery">
                                                    <div class="divide-y">
                                                        @foreach ($product->getMedia('gallery')->sortBy('order_column') as $item)
                                                        <tr data-id="{{ $item->id }}">
                                                            <td>{{ $item->order_column}}</td>

                                                            <td>
                                                                <a data-fslightbox="gallery" href="{{ $item->getUrl('thumb') }}">
                                                                    <img src="{{ $item->getUrl('thumb')}}" width="50px">
                                                                </a>
                                                            </td>
                                                            <td style="background-color:{{ $item->size >= 819200 ? 'red' : 'green'}};color:white">
                                                                {{ intval($item->size / 1024)}} kb
                                                            </td>
                                                            <td>{{ $item->file_name}}
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" title="Resim Sil">
                                                                    <x-dashboard.icon.delete/> 
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">

        
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Fiyat ve Stok</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $product->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">İndirimli Fiyat</label>
                            <input type="number" step="0.01" name="discount_price" class="form-control" 
                                   value="{{ old('discount_price', $product->discount_price) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" 
                                   value="{{ old('sku', $product->sku) }}">
                        </div>
                    </div>
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

        <livewire:tag-manager type="product" />

        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/> Yayınlama</h4>
            </div>
            <div class="card-body">  
                <div class="mb-3">
                    @foreach ($status as $item)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{$item}}" {{ ($item == $product->status) ? 'checked' : null}}>
                            <span class="form-check-label">{{ $item->title()}}</span>
                        </label>
                    @endforeach
                </div>

                <hr>
                <label class="form-check form-switch mt-2">&nbsp; Google İndex
                    <input type="hidden" name="addGoogle" value="0">
                    <input class="form-check-input switch" name="addGoogle" type="checkbox" value="{{$product->addGoogle}}" {{ ($product->addGoogle) ? 'checked' : null}}>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; Yorum Yapılabilir
                    <input type="hidden" name="addComment" value="0">
                    <input class="form-check-input switch" name="addComment" type="checkbox" value="{{$product->addComment}}" {{ ($product->addComment) ? 'checked' : null}}>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; İçeriği Kaldır
                    <input type="hidden" name="deleteContent" value="0">
                    <input class="form-check-input switch" name="deleteContent" type="checkbox" value="{{$product->deleteContent}}" {{ ($product->deleteContent) ? 'checked' : null}}>
                </label>
            </div>
        </div>

        <x-dashboard.site.activity-log :model="App\Models\ProductTranslation::class" :model-id="$product->id"/>
             
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

    // CKEditor için
    document.querySelectorAll('.editor').forEach(function(element) {
        ClassicEditor
            .create(element)
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush 


@section('customJS')
    @include('backend.layout.ck')
@endsection