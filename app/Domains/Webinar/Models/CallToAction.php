<?php
namespace App\Domains\Webinar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int          webinar_id
 * @property string       title
 * @property string       description
 * @property int          delay
 * @property int          duration
 * @property string|null  button_url
 * @property string|null  button_text
 *
 * @property-read Webinar webinar
 */
class CallToAction extends Model
{
    protected $fillable = [
        'webinar_id',
        'title',
        'description',
        'delay',
        'duration',
        'button_url',
        'button_text',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}