<?php

namespace App\View\Components;

use App\Domains\Webinar\Models\CallToAction;
use Illuminate\View\Component;

class CTA extends Component
{
    /**
     * @var CallToAction
     */
    public $cta;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CallToAction $cta)
    {
        $this->cta = $cta;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cta');
    }
}
