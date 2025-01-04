@extends('backend.layout.app')

@section('content')
{!! html()->form()
    ->method('POST')
    ->action(route('translation.store'))
    ->open() !!}

    <div class="col-md-12">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-status-top bg-blue"></div>
                    <div class="card-header">
                        <h3 class="card-title">Çeviri Ekle</h3>
                        <div class="card-actions d-flex">
                            
                            <div class="p-1">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                                    <x-dashboard.icon.back/>
                                    Geri
                                </a>
                            </div>
                            <div class="p-1">
                                <button type="submit" title="Çeviri Kaydet" class="btn btn-primary">
                                    <x-dashboard.icon.save/>
                                    Kaydet
                                </a>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-dashboard.form.input label='Group Adı' name='group' placeholder="Group Adı Giriniz"/>
                <x-dashboard.form.input label='Anahtar Adı' name='key' placeholder="Anahtar Adı Giriniz"/>

                @foreach ($language as $locale)
                    <div class="mb-3">
                        <x-dashboard.form.input label='Çeviri [{{ $locale->lang }}]' name="translations[{{ $locale->lang }}]" placeholder="Anahtar Adı Giriniz"/>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    
    {!! html()->form()->close() !!}

@endsection