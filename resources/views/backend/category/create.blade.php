@extends('backend.layout.app')

@section('content')
{!! html()->form()
    ->method('POST')
    ->action(route('category.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<div class="col-12 mb-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Kategori Oluştur</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" title="Kategori Oluştur" class="btn btn-primary">
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
                </ul>
            </div>
            
            <div class="card-body">

                  @foreach($language as $lang)
                  <div class="tab-content">
                        <div class="tab-pane @if ($loop->first) active show @endif" id="{{$lang->lang}}" role="tabpanel">

                            <div class="card">
                                <div class="card-status-top bg-blue"></div>
                                <div class="card-body">
                                    <x-dashboard.form.input label='Kategori Adı' name='name:{{ $lang->lang }}' placeholder="Kategori Adı Giriniz ({{ $lang->native }})" maxlength="40"/>
                                    <x-dashboard.form.text-area label='Kısa Açıklama' name='short:{{ $lang->lang }}'/>
                                    <x-dashboard.form.text-area label='Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
                                </div>
                            </div>

                            <x-dashboard.site.seo :lang="$lang" />

                        </div>       
                  </div>
                  @endforeach
            
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">


        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.star/> Kategori </h4>
            </div>
            <div class="card-body">
                <select class="form-select tomselected {{$errors->has('category_id') ? 'is-invalid'  : ''}}" name="parent_id">
                    <option value="">Üst Kategori</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id}}"> {{ ($item->parent_id == null ? $item->name : '-'.$item->name)}}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                <div class="invalid-feedback">{{$errors->first('category_id')}}</div>
                @endif
        
            </div>
        </div>
        
        <div class="card mt-3">
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


        <div class="card mt-3">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-green">
                    <x-dashboard.icon.image/>
                </div>
            </div>
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/>İkon</h4>
            </div>
            <div class="card-body">
                <input class="form-control" type="file" name="cover">
            </div>
        </div>
     
    </div>

    <div class="col-md-4 mb-3">
        
    </div>

    <div class="col-md-4 mb-3">
       
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

@endsection