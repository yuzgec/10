@extends('backend.layout.app')
@section('content')

{!! html()->model($edit)->form('PUT', route('team.update', $edit->id))
    ->attribute('enctype', 'multipart/form-data')
    ->open() 
!!}

<div class="col-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.user/> Ekip Düzenle [{{ $edit->name }}]</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark" title="Geri Dön">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <a href="{{ route('team.detail', $edit->slug) }}" target="_blank" class="btn btn-outline-dark" title="{{$edit->name}} - Sayfasını Önizle">
                        <x-dashboard.icon.preview/>
                        Önizle
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
                <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                    @foreach($language as $properties)
                    <li class="nav-item" role="presentation">
                        <a href="#{{ $properties->lang }}" class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab">
                            <img src="/flags/{{ $properties->lang }}.svg" width="20px"><span  style="margin-left:10px">{{ $properties->native }}</span>
                        </a>
                    </li>
                    @endforeach
                    <li class="nav-item" role="presentation">
                        <a href="#image" class="nav-link" data-bs-toggle="tab">
                            <span  style="margin-left:10px"><x-dashboard.icon.image/> Medya</span>
                        </a>
                    </li>
                </ul>
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
                                                <input 
                                                    type="file" 
                                                    class="form-control image-preview-input mb-2" 
                                                    name="image" 
                                                    id="pageInput" 
                                                    data-preview-target="pagePreview"
                                                >
                                                <div class="text-center">
                                                    <img 
                                                        src="{{ $edit->getFirstMediaUrl('page', 'thumb')}}" 
                                                        style="width: 300px; cursor: pointer;" 
                                                        id="pagePreview" 
                                                        onclick="document.getElementById('pageInput').click()" 
                                                        alt="Page Image"
                                                    >
                                                </div>
                                            </div>
                                            
                                            <label class="form-check form-switch mt-2">&nbsp; Kaldır
                                                <input class="form-check-input switch" name="deleteImage" type="checkbox">
                                            </label>
                                            <small>Resmi kaldırmak için kullanın. Tekrar resim yükleyeceksiniz işaretlemenize gerek yoktur.</small>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12 mb-3">
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
                                                                    <a data-fslightbox="gallery" href="{{ $item->getUrl() }}">
                                                                        <img src="{{ $item->getUrl() }}" class="" width="50px" height="25px"/>

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

        <x-dashboard.site.category parent="32" category="{{ $edit->category_id}}"/>
       
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
                  
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                    </span>
                    <input name="facebook" type="text" value="{{$edit->facebook}}"  class="form-control" placeholder="Facebook Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M16.5 7.5v.01" /></svg> 
                    </span>
                    <input name="instagram" type="text" value="{{$edit->instagram}}" class="form-control" placeholder="İnstagram Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <x-dashboard.icon.video/>   
                    </span>
                    <input name="youtube" type="text" value="{{$edit->youtube}}"  class="form-control" placeholder="Youtube Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-twitter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                    </span>
                    <input name="twitter" type="text" value="{{$edit->twitter}}"  class="form-control" placeholder="X Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-tiktok"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917z" /></svg>
                </span>
                    <input name="tiktok" type="text" value="{{$edit->tiktok}}" class="form-control" placeholder="Tiktok Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-pinterest"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 20l4 -9" /><path d="M10.7 14c.437 1.263 1.43 2 2.55 2c2.071 0 3.75 -1.554 3.75 -4a5 5 0 1 0 -9.7 1.7" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /></svg>
                     </span>
                    <input name="pinterest" type="text" value="{{$edit->pinterest}}" class="form-control" placeholder="pinterest Username">
                </div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-linkedin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 11v5" /><path d="M8 8v.01" /><path d="M12 16v-5" /><path d="M16 16v-3a2 2 0 1 0 -4 0" /><path d="M3 7a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v10a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z" /></svg></span>
                    <input name="linkedin" type="text" value="{{$edit->linkedin}}" class="form-control" placeholder="Linkedin Username">
                </div>
            </div>
        </div>
        
    </div>



</div>


{!! html()->form()->close() !!}


@endsection

@section('customJS')
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
     {{--  Galeri Listeleme --}}
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const gallery = document.getElementById('sortable-gallery');
            new Sortable(gallery, {
                animation: 150,
                onEnd: function (evt) {
                    const order = Array.from(gallery.children).map(row => row.dataset.id);

                    fetch('{{ route('page.gallerysort') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order })
                    }).then(response => response.json())
                    .then(data => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Sıralama Başarıyla Yapıldı',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Bir hata oluştu!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                            }).catch(error => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'İstek başarısız oldu!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        console.error('Error:', error);
                    });
                }
            });
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.image-preview-input').forEach(input => {
        input.addEventListener('change', function () {
            previewImage(this);
        });
    });
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const previewId = input.getAttribute('data-preview-target');

        reader.onload = function (e) {
            const previewElement = document.getElementById(previewId);
            if (previewElement) {
                previewElement.src = e.target.result;
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection