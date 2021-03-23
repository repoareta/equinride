<?php

namespace App\Listeners;

use App\Events\StableUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStableUpdatedNotificationToAppOwnerAdmin
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
     * Handle the event.
     *
     * @param  StableUpdated  $event
     * @return void
     */
    public function handle(StableUpdated $event)
    {
        //
    }
}
