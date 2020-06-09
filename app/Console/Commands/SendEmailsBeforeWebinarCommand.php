<?php

namespace App\Console\Commands;

use App\Domains\Webinar\Models\UserWebinar;
use App\Domains\Webinar\Models\Webinar;
use App\Mail\WebinarAccessMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailsBeforeWebinarCommand extends Command
{
    protected $signature = 'email:send';

    protected $description = 'Send emails before webinar';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $webinars = Webinar::where('scheduled_at', '>=', Carbon::now()->addMinutes(1))
            ->where('scheduled_at', '<=', Carbon::now()->addMinutes(5))
            ->get();

        /** @var Webinar $webinar */
        foreach ($webinars as $webinar) {
            $subscriptions = UserWebinar::where('webinar_id', $webinar->id)
                ->whereNull('email_sent_at')
                ->with('user')
                ->get();

            /** @var UserWebinar $subscription */
            foreach ($subscriptions as $subscription) {
                $this->sendEmail($subscription->user, $webinar);
            }
        }
    }

    private function sendEmail(User $user, Webinar $webinar)
    {
        Mail::to($user)
            ->send(new WebinarAccessMail($webinar, $user->newLoginToken()));

        UserWebinar::where('user_id', $user->id)
            ->where('webinar_id', $webinar->id)
            ->update([
                'email_sent_at' => Carbon::now(),
            ]);
    }
}
