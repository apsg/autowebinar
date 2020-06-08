<?php
namespace App\Domains\Webinar\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => 'required|string|min:4',
            'email' => 'required|email',
        ];
    }
}