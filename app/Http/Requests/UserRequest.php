<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use App\Rules\EmailRule;
use App\Rules\PasswordRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $is_create = !$request->user?->id;
        return [
            'name' => ['required', new SmallTextRule()],
            'email' => [
                'required',
                Rule::unique(User::class, 'email')->whereNull('deleted_at')->ignore($request->user?->id),
                new EmailRule()
            ],
            'password' => [$is_create ? 'required' : 'nullable', new PasswordRule()],
            'avatar' => "nullable|image|max:3000|mimes:jpg,png,jpeg,gif,svg",
            'is_active' => "nullable|boolean",
            'role' => Rule::exists(Role::class, 'name'),
        ];
    }
}
