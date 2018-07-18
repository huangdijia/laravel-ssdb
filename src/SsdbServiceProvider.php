<?php

namespace Huangdijia\Ssdb;

use Huangdijia\Ssdb\Cache\Ssdb;
use Huangdijia\Ssdb\Session\SsdbSessionHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SsdbServiceProvider extends ServiceProvider
{
    /**
     * 标记着提供器是延迟加载的
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        Cache::extend('ssdb', function ($app) {
            return Cache::repository(new Ssdb($app));
        });
        Session::extend('ssdb', function ($app) {
            return new SsdbSessionHandler($app);
        });
    }

    /**
     * 注册服务提供者
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ssdb.simple', function () {
            return new Simple(
                config('cache.stores.ssdb.host', '127.0.0.1'),
                config('cache.stores.ssdb.port', '8888'),
                config('cache.stores.ssdb.timeout', 2000)
            );
        });
    }

    /**
     * 取得提供者提供的服务
     *
     * @return array
     */
    public function provides()
    {
        return ['ssdb.simple'];
    }
}
