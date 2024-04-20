<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class LoginRequest extends CustomRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
