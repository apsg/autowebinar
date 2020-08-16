<?php
namespace App\Domains\Webinar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string       title
 * @property string       description
 * @property int          delay
 * @property int          duration
 * @property string       button_url
 * @property string       button_text
 *
 * @property-read Webinar webinar
 */
class CallToAction extends Model
{
    protected $fillable = [
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