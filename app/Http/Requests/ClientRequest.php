<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\Client;
use App\Rules\{EmailRule, SaudiPhoneNumberRule, ImageRule, PasswordRule, SmallTextRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
                Rule::unique(Client::class, 'email')->whereNull('deleted_at')->ignore($request->id),
                new EmailRule()
            ],
            'phone' => ['required', Rule::unique(Client::class, 'phone')->whereNull('deleted_at'), new SaudiPhoneNumberRule()],
            'password' => ['nullable', new PasswordRule()],
            'avatar' => ['nullable', new ImageRule()],
            'is_active' => "nullable|boolean",
        ];
    }
}
