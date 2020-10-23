<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Infrastructure\Testing;

use Mockery\MockInterface;

/**
 * Class RedisFactory.
 *
 * @category Tests\Unit
 *
 * @SuppressWarnings(PHPMD)
 */
class RedisFactory
{
    /**
     * Create and return Redis mock instance.
     *
     *
     * @return MockInterface
     */
    public static function makeInstance(): MockInterface
    {
        $redis = \Mockery::mock(\Redis::class);
        $redisGetMethod = $redis->shouldReceive('get');
        $redisGetMethod->andReturnUsing(
            function ($key) {
                return $key;
            }
        );
        $redisSetMethod = $redis->shouldReceive('set');
        $redisSetMethod->andReturnUsing(
            function ($key, $value, $timeout = 0) {
                return true;
            }
        );
        $redisSaveMethod = $redis->shouldReceive('save');
        $redisSaveMethod->andReturnUsing(
            function () {
                return true;
            }
        );

        return $redis;
    }
}
