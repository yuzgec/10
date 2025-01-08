@extends('backend.layout.app')
@section('content')

{!! html()->model($edit)->form('PUT', route('blog.update', $edit->id))
    ->attribute('enctype', 'multipart/form-data')
    ->attribute('data-action', 'update')
    ->open() 
!!}

<x-dashboard.crud.edit-header :model='$edit' route="blog" name="Blog"/>


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
                                <x-dashboard.form.input required label='Blog Adı' name='name:{{ $lang->lang }}' placeholder="Blog Adı Giriniz ({{ $lang->native }})" maxlength="100"/>
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
                                                    src="{{ $edit->getFirstMediaUrl('page','img') }}" 
                                                    id="pageImagePreview" 
                                                    class="preview-image"
                                                    alt="Preview"
                                                >
                                                    <button 
                                                        type="button" 
                                                        class="delete-media-btn" 
                                                        data-model-id="{{ $edit->id ?? '' }}"
                                                        data-model-type="Blog"
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
                                                src="{{ $edit->getFirstMediaUrl('cover','img') }}" 
                                                id="coverPreview" 
                                                class="preview-image"
                                                alt="Cover"
                                                title="Resim seçmek için tıklayın"
                                            >
                                            <button 
                                                    type="button" 
                                                    class="delete-media-btn" 
                                                    data-model-id="{{ $edit->id ?? '' }}"
                                                    data-model-type="Blog"
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
                                                        @foreach ($edit->getMedia('gallery')->sortBy('order_column') as $item)
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

        <x-dashboard.crud.category :cat='$cat' :cat_id='$edit->category_id'/>
       
        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/> Yayınlama</h4>
            </div>
            <div class="card-body">  
                <div class="mb-3">
                    @foreach ($status as $item)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{$item}}" {{ ($item == $edit->status) ? 'checked' : null}}>
                            <span class="form-check-label">{{ $item->title()}}</span>
                        </label>
                    @endforeach
                </div>

                <hr>
                <label class="form-check form-switch mt-2">&nbsp; Google İndex
                    <input type="hidden" name="addGoogle" value="0">
                    <input class="form-check-input switch" name="addGoogle" type="checkbox" value="{{$edit->addGoogle}}" {{ ($edit->addGoogle) ? 'checked' : null}}>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; Yorum Yapılabilir
                    <input type="hidden" name="addComment" value="0">
                    <input class="form-check-input switch" name="addComment" type="checkbox" value="{{$edit->addComment}}" {{ ($edit->addComment) ? 'checked' : null}}>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; İçeriği Kaldır
                    <input type="hidden" name="deleteContent" value="0">
                    <input class="form-check-input switch" name="deleteContent" type="checkbox" value="{{$edit->deleteContent}}" {{ ($edit->deleteContent) ? 'checked' : null}}>
                </label>
            </div>
        </div>

        <x-dashboard.site.activity-log :model="App\Models\BlogTranslation::class" :model-id="$edit->id"/>
             
    </div>

</div>
{!! html()->form()->close() !!}
@endsection

@section('customJS')
    @include('backend.layout.ck')
  
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                initGallerySortable('{{ route('blog.gallerysort') }}');
            });
        </script>
    @endpush
@endsection