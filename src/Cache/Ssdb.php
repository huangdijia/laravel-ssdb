<?php

namespace Huangdijia\Ssdb\Cache;

use Illuminate\Contracts\Cache\Store;

class Ssdb implements Store
{
    /**
     * @var \Huangdijia\Ssdb\Ssdb
     */
    protected $ssdb;
    protected $prefix;

    public function __construct($app)
    {
        $this->ssdb = $app['ssdb.manager']->connection(
            $app['config']->get('cache.ssdb.connection', 'default')
        );
        $this->prefix = $app['config']->get('cache.prefix', '');
    }

    public function get($key)
    {
        return $this->ssdb->get($this->prefix . '_' . $key);
    }

    public function put($key, $value, $seconds)
    {
        return $this->ssdb->setx($this->prefix . '_' . $key, $value, $seconds);
    }

    public function many(array $keys)
    {
        $ret = [];
        foreach ($keys as $key) {
            $ret[$key] = $this->ssdb->get($this->prefix . '_' . $key);
        }
        return $ret;
    }

    public function putMany(array $values, $seconds)
    {
        foreach ($values as $key => $value) {
            $this->ssdb->set($this->prefix . '_' . $key, $value, $seconds);
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
