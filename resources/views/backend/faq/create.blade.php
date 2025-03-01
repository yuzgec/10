@extends('backend.layout.app')

@section('content')


{!! html()->form()
    ->method('POST')
    ->action(route('faq.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<x-dashboard.crud.create-header route='faq' name="S.S.S"/>



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
                                    <x-dashboard.form.input requiredlabel='SSS Adı' name='name:{{ $lang->lang }}' placeholder="SSS Adı Giriniz ({{ $lang->native }})" maxlength="120"/>
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
        <x-dashboard.crud.category :cat='$cat'/>
    </div>

</div>
{!! html()->form()->close() !!}

@endsection


@section('customJS')
    @include('backend.layout.ck')
@endsection