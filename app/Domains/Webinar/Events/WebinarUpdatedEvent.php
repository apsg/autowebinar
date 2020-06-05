<?php

namespace App\Domains\Webinar\Events;

use App\Domains\Webinar\Models\Webinar;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebinarUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Webinar */
    public $webinar;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Webinar $webinar)
    {
        $this->webinar = $webinar;
    }
}
