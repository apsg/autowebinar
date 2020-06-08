<?php
namespace App\Domains\Webinar\Repositories;

use App\Domains\Webinar\Models\Webinar;
use App\User;

class WebinarSubscriptionRepository
{
    public function subscribe(User $user, Webinar $webinar)
    {
        $user->webinars()->save($webinar);
    }
}