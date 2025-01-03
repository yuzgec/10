<?php

return [

    'supportedLocales' => [
        'tr' => [
            'name' => 'Turkish',
            'script' => 'Latn',
            'native' => 'Türkçe',
            'regional' => 'tr_TR',
            'active' => true
        ],
        'en' => [
            'name' => 'English',
            'script' => 'Latn',
            'native' => 'English',
            'regional' => 'en_GB',
            'active' => false
        ]
    ],

    'useAcceptLanguageHeader' => true,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => [],

    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped'],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],

];