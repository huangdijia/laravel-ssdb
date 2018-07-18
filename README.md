# Requirements

* PHP >= 5.5
* Laravel >= 5.5

# Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/ssdb
~~~

# Configurations

~~~php
// config/cache.php
    'stores' => [
        'ssdb' => [
            'host'    => '127.0.0.1',
            'port'    => 8888,
            'timeout' => 2000,
        ],
        // ...
    ]
~~~

# Usage

As Facades:

~~~php
use Huangdijia\Ssdb\Facades\Ssdb;

...
    Ssdb::set('key', 'value');
    $value = Ssdb::get('key');
~~~

As Cache:

~~~php
// config/cache.php
    'default' => 'ssdb',
~~~

or

~~~env
CACHE_DRIVER=ssdb
~~~

# Other

SSDB PHP API

> http://ssdb.io/docs/zh_cn/php/index.html