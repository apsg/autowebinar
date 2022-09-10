<?php
namespace App\Domains\Webinar\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCtaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'webinar_id'  => 'required|integer|exists:webinars,id',
            'title'       => 'required|string',
            'description' => 'required|string',
            'delay'       => 'required|numeric|min:0',
            'duration'    => 'required|numeric|min:1',
            'button_url'  => 'string|nullable|url',
            'button_text' => 'string|nullable',
        ];
    }
}
