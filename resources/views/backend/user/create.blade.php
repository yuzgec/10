@extends('backend.layout.app')
@section('content')
<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Kullanıcı Oluştur'/>
        <x-dashboard.site.preview/>
    </div>
</div>


<div class="row">
    <div class="col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-header">Kullanıcı Bilgileri</div>
            <div class="card-body">
                <form action="{{ route('user.store')}}" method="POST">
                    @csrf
                    <x-dashboard.form.input label="Ad Soyad" name="name"/>
                    <x-dashboard.form.input label="Email" name="email"/>
                    <x-dashboard.form.input label="Password" name="password"/>
                    <button class="btn btn-primary" type="submit"><x-dashboard.icon.add/> Ekle</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-header">Kullanıcı Rolleri</div>
            <div class="card-body">
              
            </div>
        </div>
    </div>


    <div class="col-md-12 col-12 mb-3">
        <div class="card">
            <div class="card-header">Kullanıcı Yetkileri</div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection