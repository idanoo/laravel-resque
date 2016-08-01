<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Connection
    |--------------------------------------------------------------------------
    |
    */

    'connection' => [
        'host'     => env('RESQUE_REDIS_HOST', 'localhost'),
        'port'     => env('RESQUE_REDIS_PORT', 6379),
        'database' => env('RESQUE_REDIS_DATABASE', 0),
    ],

    /*
    |--------------------------------------------------------------------------
    | Track Status
    |--------------------------------------------------------------------------
    |
    */

    'prefix' => env('RESQUE_PREFIX', 'resque'),

];