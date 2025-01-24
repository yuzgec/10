@extends('backend.layout.app')

@section('content')
{!! Html::form()
    ->method('POST')
    ->action(route('product.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open()
!!}

<x-dashboard.crud.create-header route='product' name="Ürün"/>

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
                                <x-dashboard.form.input required="true" label='Ürün Adı' name='name:{{ $lang->lang }}' placeholder="Ürün Adı Giriniz ({{ $lang->native }})" maxlength="40"/>
                                <x-dashboard.form.text-area label='Kısa Açıklama' name='short_description:{{ $lang->lang }}'/>
                                <x-dashboard.form.text-area label='Açıklama' name='description:{{ $lang->lang }}' id='desc'/>
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
        <x-dashboard.crud.category :cat='$categories'/>
        
        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.settings/> Ürün Detayları</h4>
            </div>
            <div class="card-body">
                <x-dashboard.form.input label='SKU' name='sku' required="true"/>
                <x-dashboard.form.input label='Fiyat' name='price' type="number" step="0.01" required="true"/>
                <x-dashboard.form.input label='İndirimli Fiyat' name='discount_price' type="number" step="0.01"/>
                <x-dashboard.form.input label='Stok' name='stock' type="number" required="true"/>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/> Yayınlama</h4>
            </div>
            <div class="card-body">  
                <div class="mb-3">
                    @foreach ($status->take(3) as $item)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{$item->value}}" id='{{ $item->id()}}' @if($item->value == 1) checked @endif>
                            <span class="form-check-label">{{ $item->title()}}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{!! Html::form()->close() !!}
@endsection

@section('customJS')
    @include('backend.layout.ck')
@endsection 