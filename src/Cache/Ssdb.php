<?php

namespace Huangdijia\Ssdb\Cache;

use Huangdijia\Ssdb\Simple;
use Illuminate\Contracts\Cache\Store;

class Ssdb implements Store
{
    protected $ssdb;
    protected $prefix;

    public function __construct($app)
    {
        $config     = $this->_getConfig($app);
        $this->ssdb = new Simple(
            $config['host'],
            $config['port'],
            $config['timeout']
        );
        $this->prefix = $config['prefix'];
    }

    public function get($key)
    {
        return $this->ssdb->get($this->prefix . '_' . $key);
    }

    public function put($key, $value, $minutes)
    {
        return $this->ssdb->setx($this->prefix . '_' . $key, $value, $minutes);
    }

    public function many(array $keys)
    {
        $ret = [];
        foreach ($keys as $key) {
            $ret[$key] = $this->ssdb->get($this->prefix . '_' . $key);
        }
        return $ret;
    }

    public function putMany(array $values, $minutes)
    {
        foreach ($values as $key => $value) {
            $this->ssdb->set($this->prefix . '_' . $key, $value, $minutes);
        }
        return true;
    }

    public function increment($key, $value = 1)
    {
        $value = (int) $value;
        return $this->ssdb->incr($this->prefix . '_' . $key, $value);
    }

    public function decrement($key, $value = 1)
    {
        $value = (int) $value;
        return $this->ssdb->incr($this->prefix . '_' . $key, -$value);
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function forget($key)
    {
        return $this->ssdb->del($this->prefix . '_' . $key);
    }

    public function forever($key, $value)
    {
        return $this->ssdb->set($this->prefix . '_' . $key, $value);
    }

    public function flush()
    {
        return $this->ssdb->flushdb();
    }

    private function _getConfig($app)
    {
        $config = $app['config']['cache']['stores']['ssdb'] ?? [];

        return [
            'host'    => array_get($config, 'host', '127.0.0.1'),
            'port'    => array_get($config, 'port', 8888),
            'timeout' => array_get($config, 'timeout', 2000),
            'prefix'  => array_get($app['config']['cache'], 'prefix'),
        ];
    }
}
