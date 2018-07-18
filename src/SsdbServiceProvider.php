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
                config('cache.stores.ssdb.host'),
                config('cache.stores.ssdb.port'),
                config('cache.stores.ssdb.timeout')
            );
        });
    }
}