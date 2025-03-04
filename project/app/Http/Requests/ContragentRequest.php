<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContragentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'ogrn' => ['required'],
            'address' => ['required'],
            'user_id' => ['required', 'exists:users'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
