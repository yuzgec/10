@extends('backend.layout.app')
@section('content')
    
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><x-dashboard.icon.add/>İş Oluştur</h3>


    </div>

    <div class="card-body">
        <x-dashboard.form.input label='İş Adı' name='work_name' placeholder="İş Adı Giriniz"/>
        <x-dashboard.form.input label='Web Site' name='work_website' placeholder="Web Site Adı Giriniz"/>

        <div class="form-group mb-3 row">
            <label class="form-label col-3 col-form-label">İş Türü </label>
            <div class="col">
                <select name="work_category" class="form-control">
                    @foreach ($type as $item)
                    <option value="{{$item->id}}">{{ $item->name}}</option>
                    @endforeach
                </select>
                    
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="form-label col-3 col-form-label">Fiyat </label>
           
            <div class="col-5">
                <div class="input-group mb-2">
                    <span class="input-group-text"><x-dashboard.icon.lira/></span>

                    <input type="text" class="form-control" name="work_offer" placeholder="Teklif Fiyatı" autocomplete="off" value="{{ old('offer') }}">
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-2">
                    <span class="input-group-text"><x-dashboard.icon.lira/></span>
                    <input type="text" class="form-control" name="work_price" placeholder="son Fiyat" autocomplete="off" value="{{ old('price') }}">
                </div>
            </div>
        </div>

        <x-dashboard.form.textarea label='Açıklama ' name='work_desc'/>




    </div>
</div>
@endsection