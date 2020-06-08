<?php
namespace App\Domains\Webinar\Models;

use App\Domains\Chat\Models\Message;
use App\Domains\Webinar\Events\WebinarUpdatedEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int                    id
 * @property string                 name
 * @property string                 description
 * @property string                 video
 * @property Carbon                 scheduled_at
 * @property Carbon                 created_at
 * @property Carbon                 updated_at
 *
 * @property-read Collection|User[] users
 *
 * @method static Builder future()
 */
class Webinar extends Model
{
    protected $fillable = [
        'name',
        'description',
        'video',
        'scheduled_at',
    ];

    protected $dates = [
        'scheduled_at',
    ];

    protected $appends = [
        'diff',
    ];

    protected $dispatchesEvents = [
        'updated' => WebinarUpdatedEvent::class,
        'created' => WebinarUpdatedEvent::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(UserWebinar::class);
    }

    /**
     * Positive values - the show is running (started in the past)
     * Negative values - time to start
     * @return int
     */
    public function getDiffAttribute()
    {
        $diffInSeconds = $this->scheduled_at->diffInSeconds();

        if ($this->scheduled_at->isFuture()) {
            return -$diffInSeconds;
        }

        return $diffInSeconds;
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function scopeFuture(Builder $query)
    {
        return $query->where('scheduled_at', '>=', Carbon::now());
    }

    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }

    public function isActive() : bool
    {
        if ($this->scheduled_at->isFuture()) {
            return false;
        }

        if ($this->scheduled_at->isPast() && $this->scheduled_at->diffInSeconds() < 300) {
            return true;
        }

        return false;
    }

    public function isFuture() : bool
    {
        return $this->scheduled_at->isFuture();
    }

    public function isChatEnabled() : bool
    {
        return $this->isActive();
    }
}
