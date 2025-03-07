@extends('backend.layout.app')
@section('content')


{!! html()->model($edit)->form('PUT', route('faq.update', $edit->id))
    ->attribute('data-action', 'update')
    ->open() 
!!}


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
                                    <x-dashboard.form.input required label='SSS Adı' name='name:{{ $lang->lang }}' placeholder="Sayfa Adı Giriniz ({{ $lang->native }})" maxlength="120"/>
                                    <x-dashboard.form.text-area label='SSS Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
                                </div>
                            </div>


                        </div>       
                  </div>
                  @endforeach
            
            </div>
        </div>
    
    </div>

    <div class="col-md-3 mb-3 p-1">

            <x-dashboard.crud.category :cat='$cat' :cat_id='$edit->category_id'/>
            
            <x-dashboard.site.activity-log 
            :model="App\Models\FaqTranslation::class"
            :model-id="$edit->id"
        />
       
    </div>
</div>
{!! html()->form()->close() !!}
@endsection
@section('customJS')
    @include('backend.layout.ck')
@endsection