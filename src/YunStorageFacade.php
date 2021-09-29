<?php

namespace YunStorage\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method \OSS\OssClient|\Qcloud\Cos\Client client() Gets the storage client, return the actual storage object
 * @method object createBucket($bucket) Creates bucket
 * @method bool doesBucketExist($bucket) Checks if a bucket exists
 * @method bool deleteBucket($bucket) Deletes bucket
 * @method array listBuckets() Lists the Bucket
 * @method object putObject($bucket, $object, $content) Uploads the $content object
 * @method string doesObjectExist($bucket, $object) Checks if the object exists
 * @method object deleteObject($bucket, $object) Deletes a object
 * @method object deleteObjects($bucket, $objects) eletes multiple objects in a bucket
 * @method string getObject($bucket, $object) Gets Object content
 * @method array listObjectKeys($bucket, $prefix) Lists the bucket's object keys
 * 
 * @see \YunStorage\Adapter\AliyunOssAdapter
 * @see \YunStorage\Adapter\TencentCosAdapter
 * @author Changfeng Ji <jichf@qq.com>
 */
class YunStorageFacade extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'yun_storage';
    }

}
