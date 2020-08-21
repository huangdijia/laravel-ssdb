# laravel-ssdb

[![Latest Stable Version](https://poser.pugx.org/huangdijia/laravel-ssdb/version.png)](https://packagist.org/packages/huangdijia/laravel-ssdb)
[![Total Downloads](https://poser.pugx.org/huangdijia/laravel-ssdb/d/total.png)](https://packagist.org/packages/huangdijia/laravel-ssdb)

## Requirements

* PHP >= 7.0
* Laravel >= 5.5

## Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/laravel-ssdb
~~~

## Configurations

~~~php
// config/database.php

    'ssdb'        => [
        'default'     => 'default',
        'connections' => [
            'default' => [
                'host'     => env('SSDB_HOST', '127.0.0.1'),
                'port'     => env('SSDB_PORT', 8888),
                'timeout'  => env('SSDB_TIMEOUT', 2000),
                'password' => 'your-password', // optional
            ],
        ],
        // ...
    ],
~~~

## Usage

### Connection

~~~php
$ssdb = Ssdb::connection('default');
~~~

### As Facades

~~~php
use Huangdijia\Ssdb\Facades\Ssdb;

...
Ssdb::set('key', 'value');
$value = Ssdb::get('key');
~~~

### As Helper

~~~php
ssdb()->set('key', 'value');
ssdb()->get('key');
~~~

### As Cache Store Driver

~~~php
// config/cache.php
'default' => 'ssdb',

'ssdb' => [
    'driver'     => 'ssdb',
    'connection' => 'default',
],
~~~

or

set .env as

~~~env
CACHE_DRIVER=ssdb
~~~

### As Session Manager

~~~php
// config/session.php
'driver' => 'ssdb',
~~~

or

set .env as

~~~env
SESSION_DRIVER=ssdb
~~~

## Other

[SSDB PHP API](http://ssdb.io/docs/zh_cn/php/index.html)

## License

laravel-ssdb is licensed under The MIT License (MIT).
