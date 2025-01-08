@extends('backend.layout.app')
@section('content')

{!! Html::form()
    ->method('POST')
    ->action(route('customer.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<div class="col-12 mb-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
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
            <div class="card-status-top bg-blue"></div>
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
                            <x-dashboard.form.only-input  name='tax_place' placeholder="Vergi Dairesi" icon="building"/>
                        </div>
                        <div class="col-md-5">
                            <x-dashboard.form.only-input  name='tax_number' placeholder="Vergi No" icon="tax"/>
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

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Email Adresi</label>
                        <div class="col-md-4">
                            <x-dashboard.form.only-input icon="envelope" label='Email 1' name='email1' placeholder="örn: info@firmadi.com"/>
                        </div>
                        <div class="col-md-5">
                            <x-dashboard.form.only-input icon="envelope" label='Email 2' name='email2' placeholder="örn: godijital@gmail.com"/>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Web Sitesi</label>
                        <div class="col-md-4">
                            <x-dashboard.form.only-input icon="home" label='Web Site 1' name='website1' placeholder="örn: example.com"/>
                        </div>
                        <div class="col-md-5">
                            <x-dashboard.form.only-input icon="home" label='Web Site 2' name='website2' placeholder="örn: example.com"/>
                        </div>
                    </div>


                    <x-dashboard.form.text-area label='Adres' name='address' placeholder="Adres Bilgisi"/>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">İl / İlçe</label>
                        </div>
                        <div class="col-md-5">
                            <select name="city_id" id="citySelect" class="form-select">
                                <option value="">İl Seçiniz</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->plate_no }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <select name="district_id" id="districtSelect" class="form-select" disabled>
                                <option value="">Önce İl Seçiniz</option>
                            </select>
                        </div>
                    </div>

                    <x-dashboard.form.textarea label='Not' name='note' placeholder="Müşteri Hakkında Bilgi"/>
            
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
                
                <input type="hidden" name="selectedTags" wire:model="selectedTags">
                <livewire:customer-tag-manager :model="null" />
            </div>
        </div>
    </div>
</div>

{!! html()->form()->close() !!}
@endsection

@section('customJS')
<script>
document.getElementById('citySelect').addEventListener('change', function() {
    const cityId = this.value;
    const districtSelect = document.getElementById('districtSelect');
    
    if (!cityId) {
        districtSelect.disabled = true;
        districtSelect.innerHTML = '<option value="">Önce İl Seçiniz</option>';
        return;
    }
    
    fetch(`/go/crm/customer/districts/${cityId}`)
        .then(response => response.json())
        .then(districts => {
            districtSelect.innerHTML = '<option value="">İlçe Seçiniz</option>';
            districts.forEach(district => {
                districtSelect.add(new Option(district.name, district.id));
            });
            districtSelect.disabled = false;
        });
});
</script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('tags-updated', (data) => {
            document.getElementById('selectedTagsInput').value = JSON.stringify(data.selectedTags);
        });
    });
</script>
@endsection
