<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContragentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'inn' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
