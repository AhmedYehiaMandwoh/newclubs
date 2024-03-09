<?php

namespace App\Http\Requests;

use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', new SmallTextRule()],
            'remember' => 'nullable|boolean'
        ];
    }
}
