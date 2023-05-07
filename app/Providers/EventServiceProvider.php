<?php

namespace App\Providers;

use App\Events\Links\ViewSharingContentSucceededEvent;
use App\Listeners\LogActivityEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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

        // Sharing
        ViewSharingContentSucceededEvent::class => [
            LogActivityEventListener::class
        ],
        ViewSharingContentFailedEvent::class => [
            LogActivityEventListener::class
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
