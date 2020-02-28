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
        $this->app->singleton(Manager::class, function ($app) {
            return new Manager($app['config']->get('database.ssdb', []));
        });

        $this->app->alias(Manager::class, 'ssdb.manager');
    }

    /**
     * 服务提供
     * @return array 
     */
    public function provides()
    {
        return [
            Manager::class,
            'ssdb.manager',
        ];
    }
}
