<?php

namespace Huangdijia\Ssdb;

use Illuminate\Support\ServiceProvider;

class SsdbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

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
}