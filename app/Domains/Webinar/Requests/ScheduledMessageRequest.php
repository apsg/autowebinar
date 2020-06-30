<?php
namespace App\Domains\Webinar\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduledMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'time'    => 'required|numeric|min:0',
            'name'    => 'required|string|min:3',
            'message' => 'required|string|min:1',
        ];
    }
}
