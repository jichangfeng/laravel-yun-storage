<?php

namespace YunStorage\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * @author Changfeng Ji <jichf@qq.com>
 */
class YunStorageServiceProvider extends ServiceProvider implements DeferrableProvider {

    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__ . '/../config/yun_storage.php' => config_path('yun_storage.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('yun_storage', function ($app) {
            $ossConfig = config('yun_storage.adapters.oss', []);
            $cosConfig = config('yun_storage.adapters.cos', []);
            $default = config('yun_storage.default', '');
            $storage = new \YunStorage\StorageManager();
            if ($ossConfig) {
                $storage->registerAdapter('oss', $ossConfig);
            }
            if ($cosConfig) {
                $storage->registerAdapter('cos', $cosConfig);
            }
            if ($default) {
                $storage->setDefaultAdapter($default);
            }
            return $storage;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['yun_storage'];
    }

}
