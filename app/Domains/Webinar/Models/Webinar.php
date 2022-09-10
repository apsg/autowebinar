<?php

namespace App\Domains\Webinar\Models;

use App\Domains\Chat\Models\Message;
use App\Domains\Chat\Models\ScheduledMessage;
use App\Domains\Chat\Transformers\MessageTransformer;
use App\Domains\Chat\Transformers\ScheduledMessageTransformer;
use App\Domains\Webinar\Events\WebinarUpdatedEvent;
use App\Helpers\FractalHelper;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;

/**
 * @class App\Domains\Webinar\Models\Webinar
 *
 * @property int                                id
 * @property string                             name
 * @property string                             description
 * @property string                             video
 * @property int                                length
 * @property Carbon                             scheduled_at
 * @property string                             repeat
 * @property Carbon                             created_at
 * @property Carbon                             updated_at
 * @property string|null                        slug
 * @property string|null                        background
 * @property string|null                        presenter_url
 * @property string|null                        presenter_description
 * @property string|null                        logo
 * @property-read Collection|User[]             users
 * @property-read Collection|Message[]          messages
 * @property-read array                         all_messages
 * @property-read Collection|ScheduledMessage[] scheduled_messages
 * @property-read Collection|ScheduledMessage[] scheduled_future_messages
 * @property-read int|null                      current_time
 * @property-read Collection|CallToAction[]     ctas
 *
 * @method static Builder future()
 * @method static Builder finished()
 */
class Webinar extends Model
{
    protected $fillable = [
        'name',
        'description',
        'video',
        'scheduled_at',
        'length',
        'repeat',
        'slug',
        'background',
        'presenter_url',
        'presenter_description',
        'logo',
    ];

    protected $dates = [
        'scheduled_at',
    ];

    protected $appends = [
        'diff',
        'current_time',
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

    public function messages()
    {
        return $this->hasMany(Message::class)
            ->orderBy('created_at');
    }

    public function scheduled_messages()
    {
        return $this->hasMany(ScheduledMessage::class)
            ->orderBy('time');
    }

    public function ctas()
    {
        return $this->hasMany(CallToAction::class);
    }

    public function getAllMessagesAttribute(): SupportCollection
    {
        $messages = $this->getTransformedMessagesForUser();
        $scheduled = $this->getTransformedScheduledMessages();

        $allMessages = collect($messages)->push(...$scheduled);

        return $allMessages->sortBy('timestamp');
    }

    public function getMessagesForUser(User $user = null): SupportCollection
    {
        $messages = $this->getTransformedMessagesForUser($user);
        $scheduled = $this->getTransformedScheduledMessages();

        $allMessages = collect($messages)->push(...$scheduled);

        return $allMessages->sortBy('timestamp');
    }

    public function getScheduledFutureMessagesAttribute()
    {
        return $this->scheduled_messages()
            ->where('time', '>', $this->current_time)
            ->get();
    }

    public function getTransformedMessagesForUser(User $user = null): array
    {
        if ($user === null) {
            return [];
        }

        $messages = $this->messages()
            ->where('user_id', $user->id)
            ->get();

        return FractalHelper::toArray($messages, new MessageTransformer());
    }

    public function getTransformedScheduledMessages(): array
    {
        return FractalHelper::toArray(
            $this->scheduled_messages()->past($this->current_time)->get(),
            new ScheduledMessageTransformer()
        );
    }

    /**
     * Positive values - the show is running (started in the past)
     * Negative values - time to start.
     *
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

    public function isActive(): bool
    {
        if ($this->scheduled_at->isFuture()) {
            return false;
        }

        if ($this->scheduled_at->isPast() && $this->scheduled_at->diffInSeconds() <= $this->length) {
            return true;
        }

        return false;
    }

    public function isFuture(): bool
    {
        return $this->scheduled_at->isFuture();
    }

    public function isChatEnabled(): bool
    {
        return $this->isActive();
    }

    public function hasPresenter(): bool
    {
        return true;

        return $this->presenter_url !== null || $this->presenter_description !== null;
    }

    public function getLink(): string
    {
        return route('webinar.show', $this);
    }

    public function getCurrentTimeAttribute(): ?int
    {
        if ($this->isFuture()) {
            return -$this->scheduled_at->diffInSeconds();
        }

        if ($this->isActive()) {
            return $this->scheduled_at->diffInSeconds();
        }

        return null;
    }

    public function scopeFinished(Builder $query)
    {
        return $query->whereRaw('time_to_sec(timediff(scheduled_at, CURRENT_TIMESTAMP)) < -length');
    }
}
