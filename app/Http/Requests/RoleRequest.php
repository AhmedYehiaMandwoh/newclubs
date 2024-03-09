<?php

namespace App\Http\Requests;

use App\Classes\Abilities;
use App\Rules\NullableSmallTextRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        return [
            'name' => ['required', new SmallTextRule(), Rule::unique('roles', 'name')->ignore($request->role?->id)],
            'abilities.*' => [Rule::in(collect(Abilities::PERMISSIONS)->pluck('key.value')->toArray())]
        ];
    }
}
