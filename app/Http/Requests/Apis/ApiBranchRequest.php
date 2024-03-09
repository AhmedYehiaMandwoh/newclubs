<?php

namespace App\Http\Requests\Apis;

use App\Classes\Helpmate;
use App\Models\Branch;
use App\Rules\{LatitudeRule, LongitudeRule, SmallTextRule};
use App\Rules\LongTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApiBranchRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'name' => [
                'required', new SmallTextRule(),
                Rule::unique(Branch::class, 'name')
                    ->where('hospitality_provider_id', Helpmate::getApiAuthTypeHospitality()->id)
                    ->ignore($request->branch?->id)
            ],
            'latitude' => ['required', new LatitudeRule()],
            'longitude' => ['required', new LongitudeRule()],
            'address' => ['required', new LongTextRule()],
            'time_of_work' => ['required', new SmallTextRule()],
        ];
    }
}
