# Overview

Laravel yun storage is a simple, but elegant laravel wrapper around [jichangfeng/yun-storage](https://github.com/jichangfeng/yun-storage).

Yun storage provides a layer that mediates between a user or configured storage frontend and one or several storage backends.

# Supported back-end storage
- [Aliyun OSS](https://www.aliyun.com/product/oss)
- [Tencent COS](https://cloud.tencent.com/product/cos)

# Run environment
- PHP 5.6+

# Install

### Composer

Execute the following command to get the latest version of the package:

```terminal
composer require jichangfeng/laravel-yun-storage
```

### Laravel >= 5.5
 - ServiceProvider、Facades will be attached automatically

#### Laravel < 5.5

In your `config/app.php` add `YunStorage\Laravel\YunStorageServiceProvider::class` to the end of the `providers` array:

```php
'providers' => [
    ...
    YunStorage\Laravel\YunStorageServiceProvider::class,
],
```

In your `config/app.php` add `YunStorageFacade` to the end of the `aliases` array:

```php
'aliases' => [
    ...
    'YunStorageFacade' => YunStorage\Laravel\YunStorageFacade::class,
],
```

#### Publish Configuration

```shell
php artisan vendor:publish --provider "YunStorage\Laravel\YunStorageServiceProvider"
```
# Usage

#### Configuration
```php
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
```

#### Instruction

```php
try {
    //Set the default storage adapter name. Supported: "oss", "cos"
    \YunStorage\Laravel\YunStorageFacade::setDefaultAdapter('oss');
    //
    //If your application interacts with default storage adapter.
    \YunStorage\Laravel\YunStorageFacade::putObject($bucket, $object, $content);
    //
    //If your application interacts with multiple storage adapters,
    //you may use the 'adapter' method to work on a particular storage adapter.
    \YunStorage\Laravel\YunStorageFacade::adapter('oss')->putObject($bucket, $object, $content);
    \YunStorage\Laravel\YunStorageFacade::adapter('cos')->putObject($bucket, $object, $content);
    //
    //Directly call the storage object at the back-end of the storage adapter
    \YunStorage\Laravel\YunStorageFacade::adapter()->client();
    \YunStorage\Laravel\YunStorageFacade::adapter('oss')->client()->listObjects($bucket, $options);
    \YunStorage\Laravel\YunStorageFacade::adapter('cos')->client()->listObjects($arg);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

#### Method

```php
try {
    //Creates bucket
    \YunStorage\Laravel\YunStorageFacade::createBucket($bucket);
    //
    //Checks if a bucket exists
    \YunStorage\Laravel\YunStorageFacade::doesBucketExist($bucket);
    //
    //Deletes bucket
    \YunStorage\Laravel\YunStorageFacade::deleteBucket($bucket);
    //
    //Lists the Bucket
    \YunStorage\Laravel\YunStorageFacade::listBuckets();
    //
    //Uploads the $content object.
    \YunStorage\Laravel\YunStorageFacade::putObject($bucket, $object, $content);
    //
    //Checks if the object exists
    \YunStorage\Laravel\YunStorageFacade::doesObjectExist($bucket, $object);
    //
    //Deletes a object
    \YunStorage\Laravel\YunStorageFacade::deleteObject($bucket, $object);
    //
    //Deletes multiple objects in a bucket
    \YunStorage\Laravel\YunStorageFacade::deleteObjects($bucket, $objects);
    //
    //Gets Object content
    \YunStorage\Laravel\YunStorageFacade::getObject($bucket, $object);
    //
    //Lists the bucket's object keys
    \YunStorage\Laravel\YunStorageFacade::listObjectKeys($bucket, $prefix);
    //
    // Gets the storage client, return the actual storage object
    \YunStorage\Laravel\YunStorageFacade::adapter()->client();
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

#### Example

```php
<?php
try {
    $bucket = 'yun-storage-example';
    $object = 'aa-bb/cc-dd/2021-09-26/ee-ff.json';
    $object2 = 'aa-bb/cc-dd/2021-09-26/ee-ff-2.json';
    $content = '{"type":"text", "data":{"msg":"some message"}}';
    $content2 = '{"type":"text", "data":{"msg":"other message"}}';
    $prefix = 'aa-bb/cc-dd';
    echo 'createBucket: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::createBucket($bucket));
    echo PHP_EOL;
    echo 'doesBucketExist: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::doesBucketExist($bucket));
    echo PHP_EOL;
    echo 'listBuckets: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::listBuckets($bucket));
    echo PHP_EOL;
    echo 'putObject: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::putObject($bucket, $object, $content));
    echo PHP_EOL;
    echo 'putObject2: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::putObject($bucket, $object2, $content2));
    echo PHP_EOL;
    echo 'doesObjectExist: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::doesObjectExist($bucket, $object));
    echo PHP_EOL;
    echo 'getObject: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::getObject($bucket, $object));
    echo PHP_EOL;
    echo 'getObject2: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::getObject($bucket, $object2));
    echo PHP_EOL;
    echo 'listObjectKeys: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::listObjectKeys($bucket, $prefix));
    echo PHP_EOL;
    echo 'deleteObject: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::deleteObject($bucket, $object));
    echo PHP_EOL;
    echo 'deleteObject2: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::deleteObject($bucket, $object2));
    echo PHP_EOL;
    echo 'deleteObjects: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::deleteObjects($bucket, [$object, $object2]));
    echo PHP_EOL;
    echo 'deleteBucket: ' . PHP_EOL;
    print_r(\YunStorage\Laravel\YunStorageFacade::deleteBucket($bucket));
    echo PHP_EOL;
} catch (\Exception $e) {
    echo 'exception: ' . $e->getCode() . ' - ' . $e->getMessage();
    echo PHP_EOL;
}
```