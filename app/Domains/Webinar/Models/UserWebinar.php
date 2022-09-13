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
 * @property Carbon|null  email_sent_at
 * @property Carbon|null  subscribed_at
 * @property Carbon|null  started_at
 * @property Carbon|null  finished_at
 * @property-read User    user
 * @property-read Webinar webinar
 */
class UserWebinar extends Pivot
{
    protected $guarded = [];

    protected $dates = [
        'email_sent_at',
        'subscribed_at',
        'started_at',
        'finished_at',
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

    public function getTimeSpentFormatted(): ?string
    {
        if ($this->started_at === null || $this->finished_at === null) {
            return null;
        }

        return $this->finished_at->diffInSeconds($this->started_at) . ' s';
    }
}
