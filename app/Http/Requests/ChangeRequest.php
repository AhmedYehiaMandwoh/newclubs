<?php

namespace App\Http\Requests;

use App\Models\PasswordReset;
use App\Rules\PasswordRule;
use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChangeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        return [
            'token' => 'required',
            'password' => ['required', 'confirmed', new PasswordRule()],
        ];
    }
}
