<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Infrastructure\Testing;

use Redis;

/**
 * Class RedisInMemory.
 *
 * @category Infrastructure\Utils
 */
class RedisInMemory extends Redis
{
    /**
     * In memory storage.
     *
     * @var mixed[]
     */
    private $storage = [];

    /**
     * Connects to a Redis instance.
     *
     * @param string $host          can be a host, or the path to a unix domain socket
     * @param int    $port          optional
     * @param float  $timeout       value in seconds (optional, default is 0.0 meaning unlimited)
     * @param null   $reserved      should be null if $retry_interval is specified
     * @param int    $retryInterval retry interval in milliseconds
     * @param float  $readTimeout   value in seconds (optional, default is 0 meaning unlimited)
     *
     * @return bool TRUE
     */
    public function connect($host, $port = 6379, $timeout = 0.0, $reserved = null, $retryInterval = 0, $readTimeout = 0.0)
    {
        return  true;
    }

    /**
     * Get the value related to the specified key.
     *
     * @param string $key
     *
     * @return string
     *
     * @example $redis->get('key');
     */
    public function get($key)
    {
        return $this->storage[$key] ?? false;
    }

    /**
     * Set the string value in argument as value of the key.
     *
     * @param string      $key
     * @param string      $value
     * @param int|mixed[] $timeout [optional] Calling setex() is preferred if you want a timeout.<br>
     *
     * @return bool TRUE if the command is successful
     *
     * @example $redis->set('key', 'value');
     */
    public function set($key, $value, $timeout = 0): bool
    {
        $this->storage[$key] = $value;

        return true;
    }

    /**
     * Performs a synchronous save.
     *
     * @return bool
     *
     * @example $redis->save();
     */
    public function save()
    {
        return true;
    }
}
