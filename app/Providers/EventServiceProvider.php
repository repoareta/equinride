<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\StableUpdated;
use App\Listeners\SendStableUpdatedNotificationToAppOwnerAdmin;
use App\Events\StableCreated;
use App\Listeners\SendStableCreatedNotificationToAppOwnerAdmin;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StableCreated::class => [
            SendStableCreatedNotificationToAppOwnerAdmin::class
        ],
        StableUpdated::class => [
            SendStableUpdatedNotificationToAppOwnerAdmin::class
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
