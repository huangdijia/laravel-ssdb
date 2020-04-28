<?php

namespace Huangdijia\Ssdb;

use Illuminate\Support\Arr;

class Manager
{
    /**
     * The configs
     * @var array
     */
    protected $config;
    /**
     * The connections
     * @var \Huangdijia\Ssdb\Simple[]
     */
    protected $connections;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Get config
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function config(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        return Arr::get($this->config, $key, $default);
    }

    /**
     * get connection
     * @param mixed|null $name
     * @return \Huangdijia\Ssdb\Simple
     */
    public function connection($name = null)
    {
        $name = $name ?: Arr::get($this->config, 'default', 'default');

        if (!isset($this->connections[$name])) {
            if (!isset($this->config['connections'][$name])) {
                throw new Exception("config 'database.ssdb.connections.{$name}' is undefined", 1);
            }

            $config = $this->config['connections'][$name];

            $this->connections[$name] = new Simple(
                $config['host'],
                $config['port'] ?? 8888,
                $config['timeout'] ?? 2000
            );
        }

        return $this->connections[$name];
    }

    /**
     * Get all connections
     * @return \Huangdijia\Ssdb\Simple[]
     */
    public function connections()
    {
        return $this->connections;
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connection()->{$method}(...$parameters);
    }
}
