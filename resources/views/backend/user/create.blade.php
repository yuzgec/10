@extends('backend.layout.app')
@section('content')
<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Kullanıcı Oluştur'/>
        <x-dashboard.site.preview/>
    </div>
</div>


{!! html()->form()
    ->method('POST')
    ->action(route('user.store'))
    ->open() !!}



<div class="row">
    <div class="col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>

            <div class="card-header">Kullanıcı Bilgileri</div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <x-dashboard.form.input label="Ad Soyad" name="name"/>
                    <x-dashboard.form.input label="Email" name="email"/>
                    <x-dashboard.form.input label="Password" name="password"/>
                    <button class="btn btn-primary" type="submit">
                        <x-dashboard.icon.add/> Ekle
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>

            <div class="card-header">Kullanıcı Rolleri</div>
            <div class="card-body">
                <div class="form-group">
                <select name="roles" id="roles" class="form-control">
                    <option value="">Rol Seçiniz</option>
                    @foreach($roles as $item )
                    <option value="{{ $item->name}}">{{ $item->name}}</option>
                    @endforeach
                 
                </select>
            </div>
            </div>
        </div>
    </div>
    {!! html()->form()->close() !!}

@endsection