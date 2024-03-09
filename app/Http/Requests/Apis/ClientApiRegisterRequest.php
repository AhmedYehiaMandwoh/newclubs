<?php

namespace App\Http\Requests\Apis;

use App\Models\Role;
use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\{SmallTextRule, SaudiPhoneNumberRule, ImageRule, PasswordRule, EmailRule};
use Illuminate\Validation\Rule;

class ClientApiRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new SmallTextRule()],
            'email' => ['required', Rule::unique(Client::class, 'email')->whereNull('deleted_at'), new EmailRule()],
            'phone' => ['required', Rule::unique(Client::class, 'phone')->whereNull('deleted_at'), new SaudiPhoneNumberRule()],
            'password' => ['required', 'confirmed', new PasswordRule()],
            'avatar' => ['nullable', new ImageRule()],
        ];
    }
}
