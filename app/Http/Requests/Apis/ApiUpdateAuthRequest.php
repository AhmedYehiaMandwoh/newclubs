<?php

namespace App\Http\Requests\Apis;

use App\Classes\Helpmate;
use App\Rules\{EmailRule, ImageRule, PasswordRule, SaudiPhoneNumberRule, SmallTextRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApiUpdateAuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $auth_user = Helpmate::getApiAuth();
        return [
            'name' => [new SmallTextRule()],
            'email' => [
                Rule::unique(get_class($auth_user), 'email')->whereNull('deleted_at')->ignore($auth_user->id),
                new EmailRule()
            ],
            'phone' => [
                Rule::unique(get_class($auth_user), 'phone')->whereNull('deleted_at')->ignore($auth_user->id),
                new SaudiPhoneNumberRule()],
            'password' => ['nullable', new PasswordRule()],
            'avatar' => ['nullable', new ImageRule()],
        ];
    }
}
