<?php

return [

    'default_auth_profile' => env('GOOGLE_CALENDAR_AUTH_PROFILE', 'service_account'),

    'auth_profiles' => [

        /*
         * Authenticate using a service account.
         */
        'service_account' => [
            /*
             * Path to the json file containing the credentials.
             */
            'credentials_json' => public_path('go-dijital-calendar-b83ffbfad0e9.json'),
        ],

        /*
         * Authenticate with actual google user account.
         */
        'oauth' => [
            /*
             * Path to the json file containing the oauth2 credentials.
             */
            'credentials_json' => public_path('client_secret_609782130993-mcfont6sis3lvdk8rhtfoilregmicu1l.apps.googleusercontent.com.json'),

            /*
             * Path to the json file containing the oauth2 token.
             */
            'token_json' => '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',
        ],
    ],

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => 'primary',

     /*
     *  The email address of the user account to impersonate.
     */
    'user_to_impersonate' => env('GOOGLE_CALENDAR_IMPERSONATE'),
];
