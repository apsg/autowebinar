<?php

namespace App\Console\Commands;

use App\Domains\Webinar\Models\Webinar;
use App\Mail\WebinarAccessMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        /** @var User $user */
        $user = User::find(1);
        $webinar = Webinar::first();

        Mail::to($user)
            ->send(new WebinarAccessMail($webinar, $user->newLoginToken()));
    }
}
