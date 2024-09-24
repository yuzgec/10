@extends('backend.layout.app')
@section('content')
{{Form::model($edit, ["route" => ["faq.update", $edit->id]])}}
@method('PUT')

<div class="col-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">S.S.S Düzenle [{{ $edit->name }}]</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark" title="Geri Dön">
                        <x-dashboard.icon.back/>
                        Geri
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
                <x-dashboard.form.input label='S.S.S Başlık' name='name' placeholder="Başlık Giriniz" maxlength="60"/>
                <x-dashboard.form.text-area label='Açıklama' name='desc' id='desc'/>
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">

        <x-dashboard.site.category parent="5" category="{{ $edit->category_id}}"/>
       
       
    </div>
</div>
{{Form::close()}}
@endsection

@section('customJS')
    <script type="text/javascript">
        CKEDITOR.replace( 'desc', {
            filebrowserUploadUrl: "{{ route('page.index', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            allowedContent: true,
            height : 400
        });
    </script>
@endsection