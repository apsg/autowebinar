<?php

namespace App;

use App\Domains\Chat\Models\Message;
use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * @property int                       id
 * @property string                    email
 * @property string                    name
 * @property string                    password
 * @property Carbon                    email_verified_at
 * @property Carbon                    created_at
 * @property Carbon                    updated_at
 *
 * @property-read Collection|Message[] messages
 * @property-read Collection|Webinar[] webinars
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function webinars()
    {
        return $this->belongsToMany(Webinar::class);
    }
}
