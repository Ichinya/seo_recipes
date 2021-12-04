<?php
/**
 * (c) Ichi, https://ichiblog.ru, 2021
 */

namespace Cache;

use Pattern\Singleton;

class Memcached
{
    use Singleton;

    private bool $use = false;
    private ?\Memcached $memcached = null;
    /** @template <address:string,port:int> */
    private array $config = [];

    public function __construct()
    {
        $this->use = (bool)getConfig('memcached', false);

        if ($this->use) {
            $this->config = getConfig('memcached');
            $this->memcached = new \Memcached();
            $this->memcached->addServer($this->config['address'], $this->config['port']) or $this->use = false;
        }
    }

    public function remember($key, $ttl, $callback)
    {
        if (!$this->use) {
            return $callback();
        }
        $get = $this->get($key);
        if ($get) {
            $this->memcached->touch($key, time() + $ttl);
            return $get;
        }
        $value = $callback();
        $this->set($key, $ttl, $value);
        return $value;
    }

    public function set($key, $ttl, $value): bool
    {
        if (!$this->use) {
            return false;
        }
        return $this->memcached->set($key, $value, time() + $ttl);
    }

    public function get($key, $default = null)
    {
        if (!$this->use) {
            return $default;
        }
        $cache = $this->memcached->get($key);
        return $cache ?: $default;
    }

    public function clear(): bool
    {
        return $this->memcached->flush();
    }

}
