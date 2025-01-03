<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-loading-text="Yükleniyor..."
    data-wait-text="Lütfen bekleyin..."
    data-processing-text="İşleniyor..."
    data-search-text="Aranıyor..."
    data-saving-text="Kaydediliyor..."
    data-deleting-text="Siliniyor..."
    data-updating-text="Güncelleniyor..."
    data-bs-theme="{{ session('theme', 'light') }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport"content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="robots" content="noindex">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>GO Dijital | Gelişmiş Yönetim Paneli</title>
        <link rel="shortcut icon" href="/frontend/img/fav.jpg">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('backend.layout.css') 
        @yield('customCSS')
        @livewireStyles
        <script src="/backend/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="{{ asset('backend/css/form-submit.css') }}">


    </head>
    <body class="" data-bs-theme="light">
        <div class="page">
            @include('backend.layout.header')
            @include('backend.layout.menu')
            <div class="page-wrapper">
               
                <div class="page-body">
                    <div class="container">
                    <div class="row">
                            @include('backend.layout.alert')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('backend.layout.footer')
            </div>
        </div>

        @include('backend.layout.js')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        @livewireScripts

        <script>
            $(document).ready(function () {
                $('#dateInput').hide();
                $('input[name="status"]').change(function () {
                    if ($('#showDateInput').is(':checked')) {
                        $('#dateInput').show();
                    } else {
                        $('#dateInput').hide();
                    }
                });

                $('#passInput').hide();
                $('input[name="status"]').change(function () {
                    if ($('#showPassInput').is(':checked')) {
                        $('#passInput').show();
                    } else {
                        $('#passInput').hide();
                    }
                });
            });
        </script>
        
        @yield('customJS')

        @stack('scripts')

        <script src="{{ asset('backend/js/form-submit.js') }}"></script>
        <script src="{{ asset('backend/js/theme-switcher.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new ThemeSwitcher();
            });
        </script>

        <a href="#" class="nav-link px-0 theme-switch-btn hide-theme-dark" title="Koyu Tema">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
            </svg>
        </a>
        <a href="#" class="nav-link px-0 theme-switch-btn hide-theme-light" title="Açık Tema" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
            </svg>
        </a>
    </body>
</html>