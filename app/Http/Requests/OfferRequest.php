<?php

namespace App\Http\Requests;

use App\Rules\{SmallTextRule, ImageRule, PercentRule, DateFormatCreatedAtRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OfferRequest extends FormRequest
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
            'branch_id' => 'required',
            'name' => [
                'required',
                new SmallTextRule(),
                Rule::unique('branches', 'name')
                    ->where('hospitality_provider_id', Auth::guard('hospitality_provider')->user()->id)
                    ->ignore($request->id)
            ],
            'avatar' => [$is_create ? 'required' : 'nullable', new ImageRule()],
            'offer_type' => ['required', new SmallTextRule()],
            'show_percent' => ['required', new PercentRule()],
            'can_use_type' => 'required',
            'valid_to_date' => ['required', new DateFormatCreatedAtRule()],
            'valid_to_type' => 'required',
            'valid_to_date' => ['nullable', new DateFormatCreatedAtRule()],
            'max_used' => 'required',

        ];
    }
}
