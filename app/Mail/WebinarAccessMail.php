<?php

namespace App\Mail;

use App\Domains\Webinar\Models\Webinar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebinarAccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Webinar */
    public $webinar;

    /** @var string */
    public $token;

    public function __construct(Webinar $webinar, string $token)
    {
        $this->webinar = $webinar;
        $this->token = $token;
    }

    public function build()
    {
        return $this->markdown('domains.webinar.emails.starting')
            ->subject('Webinar zaraz się rozpocznie');
    }
}
