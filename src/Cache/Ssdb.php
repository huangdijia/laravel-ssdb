<?php

namespace Huangdijia\Ssdb\Cache;

use Illuminate\Contracts\Cache\Store;

class Ssdb implements Store
{
    protected $ssdb;
    protected $prefix;

    public function __construct($app)
    {
        $this->ssdb   = app('ssdb.simple');
        $this->prefix = array_get($app['config']['cache'], 'prefix', '');
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
}
