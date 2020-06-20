<?php

namespace App\View\Components;

use App\Domains\Chat\Models\ScheduledMessage;
use Illuminate\View\Component;

class ScheduledMessageComponent extends Component
{
    /**
     * @var ScheduledMessage
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ScheduledMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.scheduled-message-component');
    }
}
