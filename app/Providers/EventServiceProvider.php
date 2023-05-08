<?php

namespace App\Providers;

use App\Events\Sharing\CreateSharingContentFailedEvent;
use App\Events\Sharing\CreateSharingContentSucceededEvent;
use App\Events\Sharing\ViewSharingContentSucceededEvent;
use App\Events\Sharing\ViewSharingContentFailedEvent;
use App\Events\Shield\BuildClientShieldFailedEvent;
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
        CreateSharingContentSucceededEvent::class => [
            LogActivityEventListener::class
        ],
        CreateSharingContentFailedEvent::class => [
            LogActivityEventListener::class
        ],

        // Shield
        BuildClientShieldSucceededEvent::class => [
            LogActivityEventListener::class
        ],
        BuildClientShieldFailedEvent::class => [
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
