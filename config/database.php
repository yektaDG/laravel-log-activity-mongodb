<?php

return [
    'default' => 'mongodb',
    'connections' => [
        'mongodb' => [
            'driver'   => 'mongodb',
            'host'     => env('MONGO_DB_HOST', 'localhost'),
            'port'     => env('MONGO_DB_PORT', '27017'),
            'database' => 'mydatabase',
        ],
    ],
];