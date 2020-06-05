<?php
namespace App\Domains\Webinar\Listeners;

use App\Domains\Webinar\Events\WebinarUpdatedEvent;
use App\Domains\Webinar\Services\VimeoService;
use Illuminate\Queue\InteractsWithQueue;

class UpdateVimeoDetailsListener //implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(WebinarUpdatedEvent $event)
    {
        $webinar = $event->webinar;
        $webinar->video = VimeoService::fixUrl($webinar->video);
        $webinar->saveQuietly();
    }
}
