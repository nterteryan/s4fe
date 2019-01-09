<?php

namespace App\Providers;

use App\Events\AccessTokenCreatedEvent;
use App\Listeners\RemoveOldAccessTokensListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AccessTokenCreatedEvent::class => [
            RemoveOldAccessTokensListener::class
        ]
    ];
}
