@extends('backend.layout.app')
@section('content')

{!! Html::form()
    ->method('POST')
    ->action(route('customer.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<div class="col-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.add/>Müşteri Oluştur</h3>
            <div class="card-actions d-flex">
              
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" id="save" title="Müşteri Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.save/>
                        Kaydet
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 mb-3">
        <div class="card mb-3">


        <div class="card-body">

            <x-dashboard.form.input label='Firma Adı' name='company_name' placeholder="Firma Adı Giriniz"/>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Yetkili / Personel </label>
                <div class="col-5">
                    <x-dashboard.form.only-input label='Yetkili Adı' name='authorized_person' placeholder="Yetkili Kişi Adı"/>
                </div>
                <div class="col-4">
                    <x-dashboard.form.only-input label='Personel Adı' name='staff_name' placeholder="Personel Adı"/>
                </div>
            </div>
            

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Vergi D. / Vergi No </label>
                
                <div class="col-5">
                    <div class="input-group mb-2">
                        <x-dashboard.form.only-input name='tax_place' placeholder="Vergi Dairesi"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <x-dashboard.form.only-input name='tax_number' placeholder="Vergi No"/>
                    </div>
                </div>
            </div>

            <x-dashboard.form.input label='Yetkili Adı' name='authorized_person'/>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Seçenek </label>
                <div class="col-6 col-md-3">
                    <label class="form-check form-check-single form-switch mt-2">&nbsp; Secenek1
                        <input class="form-check-input switch" name="option1" type="checkbox" value="0">
                    </label>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-check form-check-single form-switch mt-2">&nbsp; Secenek2
                        <input class="form-check-input switch" name="option2" type="checkbox" value="0">
                    </label>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-check form-check-single form-switch mt-2">&nbsp; Secenek3
                        <input class="form-check-input switch" name="option3" type="checkbox" value="0">
                    </label>
                </div>
                
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Web Site </label>
                
                <div class="col-5">
                    <div class="input-group mb-2">
                        <span class="input-group-text"><x-dashboard.icon.connect/></span>
                        <input type="text" class="form-control" name="website1" placeholder="Web Site Adı" value="{{ old('website1') }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <span class="input-group-text"><x-dashboard.icon.connect/></span>
                        <input type="text" class="form-control" name="website2" placeholder="Web Site Adı" value="{{ old('website2') }}">
                    </div>
                </div>
            </div>
        </div>


            
        </div>
        <div class="card  mt-3">
            <div class="card-body">asd</div>
        </div>


    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card">
         
            <div class="card-body">


                <h4 class="card-title"><x-dashboard.icon.image/> Firma Logo</h4>
                
                <div class="mb-3">
                  <input type="file" class="form-control" name="logo">
                </div>
                <hr>
                
                <h4 class="card-title"><x-dashboard.icon.image/> Müşteri Türü</h4>
                <div class="mb-3">
                    @foreach($status as $item)
                    <label class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="{{ $item }}" @checked(@$loop->first )>
                        <span class="form-check-label">{{ $item->title()}}</span>
                    </label>
                    @endforeach
                </div>
                <hr>
    
                <h4 class="card-title"><x-dashboard.icon.user/> İş Türü</h4>
                <div class="mb-3">
                    @foreach($type as $item)
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" name="type[]"  value="{{ $item->id}}">
                        <span class="form-check-label">{{ $item->name}}</span>
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



<script src="/backend/libs/tom-select/dist/js/tom-select.base.min.js?1695847769" defer></script>

@endsection