<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomRequest extends FormRequest
{
    public function attributes()
    {
        return [];
    }
}
