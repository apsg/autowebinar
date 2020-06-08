<?php
namespace App\Providers;

use App\Domains\Webinar\Events\WebinarUpdatedEvent;
use App\Domains\Webinar\Listeners\UpdateVimeoDetailsListener;
use App\Listeners\LogSendingMessage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class          => [
            SendEmailVerificationNotification::class,
        ],
        WebinarUpdatedEvent::class => [
            UpdateVimeoDetailsListener::class,
        ],
        MessageSending::class => [
//            LogSendingMessage::class,
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
