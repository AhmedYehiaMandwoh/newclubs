<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\HospitalityProvider;
use App\Rules\{SaudiPhoneNumberRule, SmallTextRule, PasswordRule, ImageRule, EmailRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

class ProfileHospitalityProvidersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $is_create = !$request->id;

        return [
            'name' => [$is_create ? 'required' : 'nullable', new SmallTextRule()],
            'email' => [
                $is_create ? 'required' : 'nullable',
                Rule::unique(HospitalityProvider::class, 'email')->whereNull('deleted_at')->ignore($request->id),
                new EmailRule()
            ],
            'password' => [$is_create ? 'required' : 'nullable', new PasswordRule()],
            'avatar' => ['nullable', new ImageRule()],
            'is_active' => "nullable|boolean",
            'type' => $is_create ? 'required' : 'nullable',
            'main_color' => 'nullable',
            'phone' => [$is_create ? 'required' : 'nullable', Rule::unique(HospitalityProvider::class, 'phone')->whereNull('deleted_at')->ignore($request->id), new SaudiPhoneNumberRule()],


        ];
    }
}
