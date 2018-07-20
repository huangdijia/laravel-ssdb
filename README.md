# Requirements

* PHP >= 7.0
* Laravel >= 5.5

# Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/laravel-ssdb
~~~

# Configurations

~~~php
// config/cache.php
    'stores' => [
        'ssdb' => [
            'driver'  => 'ssdb',
            'host'    => '127.0.0.1',
            'port'    => 8888,
            'timeout' => 2000,
        ],
        // ...
    ]
~~~

# Usage

## As Facades

~~~php
use Huangdijia\Ssdb\Facades\Ssdb;

...
    Ssdb::set('key', 'value');
    $value = Ssdb::get('key');
~~~

## As Helper

~~~php
ssdb()->set('key');
ssdb()->get('key');
~~~

## As Cache Store Driver

~~~php
// config/cache.php
    'default' => 'ssdb',
~~~

or

set .env as

~~~env
CACHE_DRIVER=ssdb
~~~

## As Session Manager

~~~php
// config/session.php
    'driver' => 'ssdb',
~~~

or

set .env as

~~~env
SESSION_DRIVER=ssdb
~~~

# Other

SSDB PHP API

> http://ssdb.io/docs/zh_cn/php/index.html

# License

laravel-ssdb is licensed under The MIT License (MIT).