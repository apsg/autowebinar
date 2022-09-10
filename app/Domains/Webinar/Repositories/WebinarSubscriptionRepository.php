<?php

namespace App\Domains\Webinar\Repositories;

use App\Domains\Webinar\Models\Webinar;
use App\User;
use Illuminate\Support\Facades\DB;

class WebinarSubscriptionRepository
{
    public function subscribe(User $user, Webinar $webinar)
    {
        if ($this->isUserSubscribed($user, $webinar)) {
            return;
        }

        $user->webinars()->attach($webinar->id);
    }

    public function isUserSubscribed(User $user, Webinar $webinar): bool
    {
        return DB::table('user_webinar')
            ->where('user_id', $user->id)
            ->where('webinar_id', $webinar->id)
            ->exists();
    }
}
