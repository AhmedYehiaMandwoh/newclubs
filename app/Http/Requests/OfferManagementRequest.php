<?php

namespace App\Http\Requests;

use App\Rules\{SmallTextRule, ImageRule, PercentRule, DateFormatCreatedAtRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OfferManagementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $is_create = !$request->id;
        $requests = $request->all();
        return [
            'branch_id' => 'nullable',
            'name' => [
                'required',
                new SmallTextRule(),
                Rule::unique('offers', 'name')->ignore($request->id)
            ],
            'icon' => [$is_create ? 'required' : 'nullable', new ImageRule()],
            'discount_type' => 'required',
            'discount_percent' => ['nullable', new PercentRule()],
            'show_percent' => ['required', new PercentRule()],
            'can_use_type' => 'required',
            'can_use_from_date' => [$requests['can_use_type'] == 'in_date' ? 'required' : 'nullable', new DateFormatCreatedAtRule()],
            'valid_to_type' => 'required',
            'max_used' => 'required',

        ];
    }
}
