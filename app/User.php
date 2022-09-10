<?php

namespace App;

use App\Domains\Chat\Models\Message;
use App\Domains\Webinar\Models\Webinar;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * @property int                       id
 * @property string                    email
 * @property string                    name
 * @property string                    password
 * @property string|null               login_token
 * @property Carbon                    email_verified_at
 * @property bool                      is_admin
 * @property Carbon                    created_at
 * @property Carbon                    updated_at
 * @property-read Collection|Message[] messages
 * @property-read Collection|Webinar[] webinars
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'login_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin'          => 'boolean',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function webinars()
    {
        return $this->belongsToMany(Webinar::class)
            ->as('subscription');
    }

    public function isSubscribed(Webinar $webinar): bool
    {
        return $this->webinars()->where('id', $webinar->id)->exists();
    }

    public function newLoginToken(): string
    {
        return app(UsersRepository::class)->generateNewLoginToken($this);
    }
}
