<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class RegisterRequest extends CustomRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'dni' => 'integer'
        ];
    }

    public function attributes(): array
    {
        return [ ];
    }
}
