<?php

namespace App\Providers;

use App\Events\CreatedPostEvent;
use App\Events\DeletedPostEvent;
use App\Events\LoggingPostEnevt;
use App\Events\ModeratedPostEvent;
use App\Events\UpdatedPostEvent;
use App\Listeners\CreatedPostEventListener;
use App\Listeners\DeletedPostEventListener;
use App\Listeners\LoggingPostEnevtListener;
use App\Listeners\ModerateredPostEventListener;
use App\Listeners\UpdatedPostEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        LoggingPostEnevt::class => [
            LoggingPostEnevtListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
