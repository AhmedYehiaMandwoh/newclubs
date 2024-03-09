<?php

namespace App\Http\Requests;

use App\Rules\{SmallTextRule, ImageRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SponsorRequest extends FormRequest
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
                'required', new SmallTextRule(),
                Rule::unique('sponsors', 'name')
                    ->ignore($request->id)
            ],
            'avatar' => ['nullable', new ImageRule()],
            'is_active' => 'nullable|boolean',

        ];
    }
}
