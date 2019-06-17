<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api_jwt'),
    ],


    'guards' => [
        'api' => ['driver' => 'api'],
        'api_jwt' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ]
];