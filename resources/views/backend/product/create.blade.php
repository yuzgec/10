@extends('backend.layout.app')

@section('content')


{!! html()->form()
    ->method('POST')
    ->action(route('product.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<div class="col-12 mb-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Sayfa Listesi</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" title="sayfa Oluştur" class="btn btn-primary">
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
                <x-dashboard.form.text-area label='Açıklama' name='desc' id='desc'/>
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">
        
        <x-dashboard.site.category parent="1"/>
        
        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/> Yayınlama</h4>
            </div>
            <div class="card-body">  
                <div class="mb-3">
                    @foreach ($status->take(4) as $item)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{$item->value}}" required>
                            <span class="form-check-label">{{ $item->title()}}</span>
                        </label>
                    @endforeach
                </div>

                <hr>
                <label class="form-check form-switch mt-2">&nbsp; Google İndex
                    <input class="form-check-input switch" name="addGoogle" type="checkbox" value="1" checked>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; Yorum Yapılabilir
                    <input class="form-check-input switch" name="addComment" type="checkbox" value="0">
                </label>
                <label class="form-check form-switch mt-2">&nbsp; İçeriği Kaldır
                    <input class="form-check-input switch" name="deleteContent" type="checkbox" value="0">
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
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
                <input class="form-control" type="file" name="image">
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
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
                <input class="form-control" type="file" name="cover">
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-stamp">
                <div class="card-stamp-icon bg-purple">
                    <x-dashboard.icon.image/>
                </div>
            </div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/>Foto Galeri</h4>
            </div>
            <div class="card-body">
                <input class="form-control" type="file" name="gallery[]" multiple>
            </div>
        </div>
    </div>

    <x-dashboard.site.seo/>

</div>

{!! html()->form()->close() !!}

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