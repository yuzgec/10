@extends('backend.layout.app')
@section('content')
{!! html()->model($edit)->form('PUT', route('product.update', $edit->id))
    ->attribute('enctype', 'multipart/form-data')
    ->open() 
!!}


<div class="col-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Sayfa Düzenle [{{ $edit->name }}]</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark" title="Geri Dön">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <a href="{{ route('page', $edit->slug) }}" target="_blank" class="btn btn-outline-dark" title="{{$edit->name}} - Sayfasını Önizle">
                        <x-dashboard.icon.preview/>
                        Sayfa Önizle
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" title="Formu Kaydet" class="btn btn-primary">
                        <x-dashboard.icon.save/>
                        Kaydet
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 mb-3 p-1">
        <div class="card">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-yellow">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                </div>
            </div>
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/>Genel Bilgiler</h4>
            </div>
            <div class="card-body">

                <x-dashboard.form.input label='Sayfa Adı' name='name' placeholder="Sayfa Adı Giriniz" maxlength="40"/>
                <x-dashboard.form.text-area label='Kısa Açıklama' name='short'/>
                <x-dashboard.form.text-area label='Açıklama' name='desc'/>
                
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">

        <x-dashboard.site.category parent="1" category="{{ $edit->category_id}}"/>
       
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
        
    </div>

    <x-dashboard.site.seo/>

    <div class="col-md-4 col-12 mb-3">
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
                <input class="form-control mb-2" type="file" name="image">
                <div class="text-center">
                    <img src="{{ $edit->getFirstMediaUrl('page', 'thumb')}}" class="me-2 " style="width: 300px">
                </div>
                <label class="form-check form-switch mt-2">&nbsp; Kaldır
                    <input class="form-check-input switch" name="deleteImage" type="checkbox">
                </label>
                <small>Resmi kaldırmak için kullanın. Tekrar resim yükleyeceksiniz işaretlemenize gerek yoktur.</small>

            </div>
        </div>
    </div>

    <div class="col-md-4 col-12 mb-3">
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
                <input class="form-control mb-2" type="file" name="cover">
                <div class="text-center">
                    <img src="{{ $edit->getFirstMediaUrl('cover', 'thumb')}}" class="me-2 " style="width: 300px">
                </div>
                <label class="form-check form-switch mt-2">&nbsp; Kaldır
                    <input class="form-check-input switch" name="deleteCover" type="checkbox">
                </label>
                <small>Resmi kaldırmak için kullanın. Tekrar resim yükleyeceksiniz işaretlemenize gerek yoktur.</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12 mb-3">
        <div class="card">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-purple">
                    <x-dashboard.icon.image/>
                </div>
            </div>
            <div class="card-status-top bg-blue"></div>

            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/>Foto Galeri <small style="color:gray">(Sayfa Altına Gelen Galeri)</small></h4>
            </div>
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                <input class="form-control mb-2" type="file" name="gallery[]" multiple>
                    <div class="table-responsive ">
                        <table class="table table-hover table-striped table-bordered table-center">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tbody id="orders">
                            <div class="divide-y">
                            @foreach($edit->getMedia('gallery') as $item)
                                <tr id="gallery_{{$item->id}}">
                                    <td>
                                        <img src="{{ $item->getUrl() }}" class="" width="75px"/>
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
{!! html()->form()->close() !!}
<x-dashboard.site.activities :activities="$activities" />


@endsection

@section('customJS')
    <script type="text/javascript">
        CKEDITOR.replace( 'desc', {
            filebrowserUploadUrl: "{{ route('page.index', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            allowedContent: true,
            height : 400,
        });
    </script>
@endsection