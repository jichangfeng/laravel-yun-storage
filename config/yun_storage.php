<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Default Storage Adapter
      |--------------------------------------------------------------------------
      |
      | This option controls the default storage adapter that gets used while
      | using this yun storage library.
      |
      | Supported: "oss", "cos"
      |
     */
    'default' => env('YUN_STORAGE_ADAPTER', ''),
    /*
      |--------------------------------------------------------------------------
      | Storage Adapters
      |--------------------------------------------------------------------------
      |
      | Here you may define all of the storage "adapters" for your application as
      | well as their storage adapters.
      |
     */
    'adapters' => [
        'oss' => [
            'accessKeyId' => env('YUN_STORAGE_OSS_ACCESS_KEY_ID', ''),
            'accessKeySecret' => env('YUN_STORAGE_OSS_ACCESS_KEY_SECRET', ''),
            'endpoint' => env('YUN_STORAGE_OSS_ENDPOINT', ''),
        ],
        'cos' => [
            'accessKeyId' => env('YUN_STORAGE_COS_ACCESS_KEY_ID', ''),
            'accessKeySecret' => env('YUN_STORAGE_COS_ACCESS_KEY_SECRET', ''),
            'region' => env('YUN_STORAGE_COS_REGION', ''),
            'schema' => env('YUN_STORAGE_COS_SCHEMA', 'http'),
            'appid' => env('YUN_STORAGE_COS_APPID', ''),
        ]
    ]
];
