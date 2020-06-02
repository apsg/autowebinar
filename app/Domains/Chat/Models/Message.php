<?php

namespace App\Domains\Chat\Models;

use App\Domains\Webinar\Models\Webinar;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int          id
 * @property int          user_id
 * @property int          webinar_id
 * @property string       message
 * @property Carbon       created_at
 * @property Carbon       updated_at
 *
 * @property-read User    user
 * @property-read Webinar webinar
 */
class Message extends Model
{
    protected $fillable = ['user_id', 'message', 'webinar_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
