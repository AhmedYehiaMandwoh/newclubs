<?php

namespace App\Http\Requests;

use App\Classes\Helpmate;
use App\Rules\{SmallTextRule, LatitudeRule, LongitudeRule};
use App\Rules\LongTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
                Rule::unique('branches', 'name')
                    ->where('hospitality_provider_id', Auth::guard('hospitality_provider')->user()->id)
                    ->ignore($request->id)
            ],
            'is_active' => 'nullable|boolean',
            'latitude' => ['required', new LatitudeRule()],
            'longitude' => ['required', new LongitudeRule()],
            'address' => ['required', new LongTextRule()]
        ];
    }
}
