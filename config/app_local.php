<?php

return [
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),
    'Security' => [
        'salt' => env('SECURITY_SALT', 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi1'),
    ],

    'Datasources' => [
        'default' => [
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'database' => 'dev_local',
            /**
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /**
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ]
    ],

    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];
