<?php

namespace App\Domains\Chat\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int       id
 * @property int       user_id
 * @property string    message
 * @property Carbon    created_at
 * @property Carbon    updated_at
 *
 * @property-read User user
 */
class Message extends Model
{
    protected $fillable = ['user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
