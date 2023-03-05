<?php

return [
    'default' => env('MONGODB_CONNECTION', 'mongodb'),
    'connections' => [
        'mongodb' => [
            'driver'   => 'mongodb',
            'host'     => env('MONGODB_HOST', 'localhost'),
            'port'     => env('MONGODB_PORT', 27017),
            'username' => env('MONGODB_USERNAME', ''),
            'password' => env('MONGODB_PASSWORD', ''),
            'database' => env('MONGODB_DATABASE', 'yektalog'),
        ],
    ],
];