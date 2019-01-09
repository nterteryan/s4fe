<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Events\AccessTokenCreatedEvent;

/**
 * Class RemoveOldAccessTokensListener
 * @package App\Listeners
 */
class RemoveOldAccessTokensListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  AccessTokenCreatedEvent $event
     * @return void
     */
    public function handle(AccessTokenCreatedEvent $event)
    {
        try {
            $user = $event->getUser();
            $user->tokens()
                ->where('created_at', '<', Carbon::now()->subMinute(20))
                ->delete();
        } catch (\Throwable $exception) {
            Log::warning('Can\'t remove old tokens');
        }
    }
}