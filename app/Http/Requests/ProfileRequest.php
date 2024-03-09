<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use App\Rules\EmailRule;
use App\Rules\ImageRule;
use App\Rules\PasswordRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        return [
            'name' => ['required', new SmallTextRule()],
            'email' => [
                'required',
                Rule::unique(User::class, 'email')->whereNull('deleted_at')->ignore(Auth::id()),
                new EmailRule()
            ],
            'password' => ['nullable', new PasswordRule()],
            'avatar' => ['nullable', new ImageRule()],
            'is_active' => "nullable|boolean",

        ];
    }
}
