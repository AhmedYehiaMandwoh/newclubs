<?php

namespace App\Http\Requests;

use App\Models\HospitalityProvider;
use App\Rules\EmailRule;
use App\Rules\ImageRule;
use App\Rules\PasswordRule;
use App\Rules\SaudiPhoneNumberRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HospitalityProvidersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(HospitalityProvider::class, 'name')->whereNull('deleted_at'),
                new SmallTextRule()
            ],
            'email' => [
                'required',
                Rule::unique(HospitalityProvider::class, 'email')->whereNull('deleted_at'),
                new EmailRule()
            ],
            'password' => ['required', 'confirmed', new PasswordRule()],
            'type' => 'required',
            'phone' => ['required', Rule::unique(HospitalityProvider::class, 'phone')->whereNull('deleted_at'), new SaudiPhoneNumberRule()],
            'avatar' => ['nullable', new ImageRule()],
            'main_color' => 'nullable',
            'secondary_color' => 'nullable',
            'third_color' => 'nullable',
        ];
    }
}
