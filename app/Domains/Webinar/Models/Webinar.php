<?php
namespace App\Domains\Webinar\Models;

use App\Domains\Chat\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    id
 * @property string name
 * @property string video
 * @property Carbon scheduled_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Webinar extends Model
{
    protected $fillable = [
        'name',
        'video',
        'scheduled_at',
    ];

    protected $dates = [
        'scheduled_at',
    ];

    protected $appends = [
        'diff',
    ];

    public function getDiffAttribute()
    {
        return -30;
        return -($this->scheduled_at->diffInSeconds());
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
