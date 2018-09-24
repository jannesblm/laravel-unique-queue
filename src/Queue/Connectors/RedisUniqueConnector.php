<?php

namespace Mlntn\Queue\Connectors;

use Illuminate\Support\Arr;
use Mlntn\Queue\RedisUniqueQueue;
use Illuminate\Queue\Connectors\RedisConnector;

class RedisUniqueConnector extends RedisConnector
{

    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new RedisUniqueQueue(
            $this->redis, $config['queue'],
            Arr::get($config, 'connection', $this->connection),
            Arr::get($config, 'retry_after', 60),
            Arr::get($config, 'block_for', null)
        );
    }

}
