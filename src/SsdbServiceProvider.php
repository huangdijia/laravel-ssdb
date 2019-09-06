<?php

namespace Huangdijia\Ssdb;

use Huangdijia\Ssdb\Cache\Ssdb;
use Huangdijia\Ssdb\Session\SsdbSessionHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SsdbServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        if ($this->app->has('cache')) {
            Cache::extend('ssdb', function ($app) {
                return Cache::repository(new Ssdb($app));
            });
        }

        if ($this->app->has('session')) {
            Session::extend('ssdb', function ($app) {
                return new SsdbSessionHandler($app);
            });
        }
    }

    /**
     * 注册服务提供者
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Simple::class, function () {
            return new Simple(
                config('cache.stores.ssdb.host', '127.0.0.1'),
                config('cache.stores.ssdb.port', '8888'),
                config('cache.stores.ssdb.timeout', 2000)
            );
        });

        $this->app->alias(Simple::class, 'ssdb.simple');
    }

    public function provides()
    {
        return [
            Simple::class,
            'ssdb.simple',
        ];
    }
}
