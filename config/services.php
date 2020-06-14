<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '183194096465527',
        'client_secret' => 'e6805897e0bbaac6fd34fcf53f96cbec',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '1080721736617-d40so2idqgsk3310n0vlqnlqikkqhkpu.apps.googleusercontent.com',
        'client_secret' => 'azQFBbWfLM-OiZkoPVxyjbwn',
        'redirect' => 'http://localhost:8000/login/google/callback',

    ],
    'instagram' => [
        'client_id' => '754579388613908',
        'client_secret' => 'a99158fafaccb257ecdc52070d19cca6',
        'redirect' => 'http://localhost:8000/login/instagram/callback',

    ],
];
