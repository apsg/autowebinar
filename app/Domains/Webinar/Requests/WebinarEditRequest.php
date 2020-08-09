<?php

namespace App\Domains\Webinar\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebinarEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'                  => 'required|string',
            'description'           => 'required|string',
            'video'                 => 'required|url',
            'scheduled_at'          => 'required|date',
            'slug'                  => 'required',
            'background'            => 'sometimes|string|nullable',
        ];
    }
}
