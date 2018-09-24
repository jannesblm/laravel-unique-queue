<?php

namespace Mlntn\Providers;

use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;
use Mlntn\Queue\Connectors\RedisUniqueConnector;
use Mlntn\Queue\Connectors\HorizonUniqueConnector;

class QueueServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving(QueueManager::class, function ($manager) {
            $manager->addConnector('unique', function () {
                if (defined('HORIZON_PATH')) {
                    return new HorizonUniqueConnector($this->app['redis']);
                }

                return new RedisUniqueConnector($this->app['redis']);
            });
        });
    }

}
