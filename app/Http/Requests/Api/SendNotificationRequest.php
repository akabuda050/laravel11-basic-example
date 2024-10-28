<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'to' => 'required|string',
        ];
    }
}
