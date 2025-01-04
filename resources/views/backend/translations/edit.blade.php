@extends('backend.layout.app')

@section('content')

{!! html()->model($edit)->form('PUT', route('translation.update', $edit->id))
    ->attribute('data-action', 'update')
    ->open() 
!!}

<div class="col-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Çeviri Düzenle</h3>
            <div class="card-actions d-flex">
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" class="btn btn-primary">
                        <x-dashboard.icon.save/>
                        Kaydet
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <x-dashboard.form.input label='Group' name='group' :value="$edit->group"/>
            <x-dashboard.form.input label='Key' name='key' :value="$edit->key"/>
            
                @foreach ($language as $locale)
                <x-dashboard.form.input 
                    label="{{ strtoupper($locale->lang) }} Çeviri" 
                    name="translations[{{ $locale->lang }}]" 
                />
            @endforeach
        </div>
    </div>
</div>

{!! html()->form()->close() !!}

@endsection