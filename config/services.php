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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'github' => [
        'webhook_path' => env('GITHUB_WEBHOOK_PATH', '-'),
        'webhook_token' => env('GITHUB_WEBHOOK_SECRET'),
        'app' => [
            'name' => env('GITHUB_APP_NAME'),
            'repository' => env('GITHUB_APP_REPOSITORY')
        ],
        'webapp' => [
            'name' => env('GITHUB_WEBAPP_NAME'),
            'repository' => env('GITHUB_WEBAPP_REPOSITORY')
        ]
    ],

    'twitch' => [
        'client_id' => env('TWITCH_CLIENT_ID'),
        'client_secret' => env('TWITCH_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . env('TWITCH_REDIRECT_URI'),
        'webhook' => [
            'secret' => env('TWITCH_WEBHOOK_SECRET'),
            'uri_part' => env('TWITCH_WEBHOOK_URI_PART')
        ],
        'dev_team_ids' => explode(',', env('DEV_TEAM_TWITCH_IDS', ''))
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
