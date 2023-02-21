<?php
return [
    'prefix' => [
        'backend' => 'admin',
        'api' => 'api',
        'vendor' => ''
    ],
    'namespace' => [
        'backend' => 'Auth\Http\Controllers\Backend',
        'vendor' => 'Auth\Http\Controllers\Vendor',
        'api' => 'Auth\Http\Controllers\Api',
    ],
    'as' => [
        'backend' => 'backend.',

        'vendor' => 'vendor.',
        'frontend' => 'frontend.auth.',
    ]
];
