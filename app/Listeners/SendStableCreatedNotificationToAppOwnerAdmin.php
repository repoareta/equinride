<?php

namespace App\Listeners;

use App\Events\StableCreated;
use App\Models\User;
use App\Notifications\StableCreatedNotificationToAppOwnerAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendStableCreatedNotificationToAppOwnerAdmin
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
     * @param  StableCreated  $event
     * @return void
     */
    public function handle(StableCreated $event)
    {
        $users = User::role(['app-owner', 'app-admin'])->get();

        Notification::send($users, new StableCreatedNotificationToAppOwnerAdmin($event->stable));
    }
}
