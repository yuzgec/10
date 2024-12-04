@extends('backend.layout.app')

@section('content')
    {{Form::open(['route' => 'translation.store', 'enctype' => 'multipart/form-data'])}}

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

                @foreach ($locales as $locale)
                    <div class="mb-3">
                        <x-dashboard.form.input label='Çeviri [{{ $locale }}]' name="translations[{{ $locale }}]" placeholder="Anahtar Adı Giriniz"/>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
{{Form::close()}}

@endsection