<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport"content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="robots" content="noindex">
        <title>GO Dijital | Gelişmiş Yönetim Paneli</title>
        <link rel="shortcut icon" href="/frontend/img/fav.jpg">

        @include('backend.layout.css') 
        @livewireStyles
        @yield('customCSS')
        @livewireStyles
        <style>
            .character-count {
                color: green;
            }
            .over-limit {
                color: red;
            }
        </style>
        <script src="/backend/ckeditor/ckeditor.js"></script>


    </head>
    <body class="">
        <div class="page">
            @include('backend.layout.header')
            @include('backend.layout.menu')
            <div class="page-wrapper">
               
                <div class="page-body">
                    <div class="container">
                    <div class="row">
                            @include('backend.layout.alert')

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

    </body>
</html>