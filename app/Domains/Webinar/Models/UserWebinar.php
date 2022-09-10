<?php

namespace App\Domains\Webinar\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 *  App\Domains\Webinar\Models\UserWebinar.
 *
 * @property int          user_id
 * @property int          webinar_id
 * @property Carbon       email_sent_at
 * @property-read User    user
 * @property-read Webinar webinar
 */
class UserWebinar extends Pivot
{
    protected $guarded = [];

    protected $dates = [
        'email_sent_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
