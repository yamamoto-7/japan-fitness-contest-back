<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS 設定
    |--------------------------------------------------------------------------
    |
    | Next.js など別ドメインのフロントからの API アクセスを許可するための設定です。
    | allowed_origins にフロントのURLを指定します。
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',  // ← Next.js (開発用)
        'http://127.0.0.1:3000',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
