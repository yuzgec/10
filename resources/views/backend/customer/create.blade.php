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
            <div class="card-actions">
                <a href="{{ url()->previous() }}" class="btn btn-outline-dark me-1">
                    <x-dashboard.icon.back/> Geri
                </a>
                <button type="submit" class="btn btn-primary">
                    <x-dashboard.icon.save/> Kaydet
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                   
                        <x-dashboard.form.input label='Firma Adı' name='company_name' required placeholder="Firma Adı Giriniz"/>
                  

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Yetkili / Personel</label>
                            <div class="col-md-4">
                                <x-dashboard.form.only-input label='Yetkili Adı' name='authorized_person' placeholder="Yetkili Kişi Adı" icon="user"/>
                            </div>
                            <div class="col-md-5">
                                <x-dashboard.form.only-input label='Personel Adı' name='staff_name' placeholder="Personel Adı" icon="user"/>
                            </div>
                        </div>
                 


                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Vergi Daire/NO</label>
                            <div class="col-md-4">
                                <x-dashboard.form.only-input label='Vergi Dairesi' name='tax_place' placeholder="Vergi Dairesi"/>
                            </div>
                            <div class="col-md-5">
                                <x-dashboard.form.only-input label='Vergi No' name='tax_number' placeholder="Vergi No"/>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Telefon / GSM</label>
                            <div class="col-md-4">
                                <x-dashboard.form.only-input icon="phone" label='Telefon' name='phone1' placeholder="Telefon Numarası"/>
                            </div>
                            <div class="col-md-5">
                                <x-dashboard.form.only-input icon="phone" label='GSM' name='phone2' placeholder="GSM Numarası"/>
                            </div>
                        </div>
                 
                        <x-dashboard.form.input icon="envelope" label='E-posta' type="email" name='email' placeholder="E-posta Adresi"/>
                    
                        <x-dashboard.form.text-area label='Adres' name='address' placeholder="Adres Bilgisi"/>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Web Sitesi</label>
                            <div class="col-md-4">
                                <x-dashboard.form.only-input icon="home" label='Web Site 1' name='website1' placeholder="örn: example.com"/>
                            </div>
                            <div class="col-md-5">
                                <x-dashboard.form.only-input icon="home" label='Web Site 2' name='website2' placeholder="örn: example.com"/>
                            </div>
                        </div>


                        <x-dashboard.form.textarea label='Not' name='address' placeholder="Adres Bilgisi"/>
                       
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Web Sitesi</label>
                            <div class="col-md-4">
                                <x-dashboard.form.only-input icon="home" label='Web Site 1' name='website1' placeholder="örn: example.com"/>
                            </div>
                            <div class="col-md-5">
                                <x-dashboard.form.only-input icon="home" label='Web Site 2' name='website2' placeholder="örn: example.com"/>
                            </div>
                        </div>
                    

                    <div class="col-12">
                        <label class="form-label">Seçenekler</label>
                        <div class="row g-2">
                            <div class="col-4">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="option1">
                                    <span class="form-check-label">Seçenek 1</span>
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="option2">
                                    <span class="form-check-label">Seçenek 2</span>
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="option3">
                                    <span class="form-check-label">Seçenek 3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    <x-dashboard.icon.image/> Firma Logo
                </h4>
                <input type="file" class="form-control" name="logo">
                
                <hr>

                <h4 class="card-title mb-3">
                    <x-dashboard.icon.user/> Müşteri Durumu
                </h4>
                @foreach($status as $item)
                <label class="form-check">
                    <input class="form-check-input" type="radio" name="status" 
                           value="{{ $item->value }}" @checked($loop->first)>
                    <span class="form-check-label">{{ $item->title() }}</span>
                </label>
                @endforeach

                <hr>

                <h4 class="card-title mb-3">
                    <x-dashboard.icon.menu-list/> İş Türleri
                </h4>
                @foreach($type as $item)
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" name="type[]" 
                           value="{{ $item->id }}">
                    <span class="form-check-label">{{ $item->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
</div>

{!! Html::form()->close() !!}
@endsection

@section('customJS')



<script src="/backend/libs/tom-select/dist/js/tom-select.base.min.js?1695847769" defer></script>

@endsection