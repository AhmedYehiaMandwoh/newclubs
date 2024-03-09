<?php

namespace App\Http\Requests;

use App\Rules\{SmallTextRule, ImageRule, DateFormatRule, DateFormatCreatedAtRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class WithdrawRequest extends FormRequest
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
                Rule::unique('withdraws', 'name')
                    ->ignore($request->id)
            ],
            'avatar' => ['nullable', new ImageRule()],
            'started_at' => ['required', new DateFormatCreatedAtRule()],
            'ended_at' => ['required', new DateFormatCreatedAtRule()],

        ];
    }
}
