@extends('frontend.layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">   
            <div class="col-md-8 mt-100 mb-50" >
                <div class="card">

                    <div class="card-body mt-5">
                         <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Adınız Soyadınız')" />
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"  autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Telefon')" />
                                <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')"  autofocus />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"  />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Parola')" />
                                <x-text-input id="password" class="form-control"
                                                type="password"
                                                name="password"
                                                 autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Parola Tekrar')" />
                                <x-text-input id="password_confirmation" class="form-control"
                                                type="password"
                                                name="password_confirmation"  />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml- btn-primary btn-block">
                                    {{ __('Kayıt Ol') }}
                                </x-primary-button>
                            </div>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
