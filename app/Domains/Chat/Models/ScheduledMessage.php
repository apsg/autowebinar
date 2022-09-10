<?php
namespace App\Domains\Chat\Models;

use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @class App\Domains\Chat\Models\ScheduledMessage
 *
 * @property int          id
 * @property int          webinar_id
 * @property string       name
 * @property string       message
 * @property int          time
 * @property Carbon       created_at
 * @property Carbon       updated_at
 * @property-read Webinar webinar
 * @property-read Carbon  scheduled_at
 *
 * @method static Builder past(int|null $time)
 */
class ScheduledMessage extends Model
{
    protected $fillable = [
        'webinar_id',
        'name',
        'message',
        'time',
    ];

    protected $appends = [
        'scheduled_at',
    ];

    protected $with = [
        'webinar',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function getScheduledAtAttribute()
    {
        return $this->webinar->scheduled_at->addSeconds($this->time);
    }

    /**
     * @param  Builder  $query
     * @param  int|null $time
     * @return Builder
     */
    public function scopePast(Builder $query, $time)
    {
        if (is_null($time)) {
            return;
        }

        return $query->where('time', '<=', $time);
    }
}
