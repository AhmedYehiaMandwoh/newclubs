<?php

namespace App\Http\Requests\Apis;

use App\Enums\OfferCanUseTypeEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Enums\OfferValidToTypeEnum;
use Illuminate\Validation\Rules\Enum;
use App\Rules\{SmallTextRule, ImageRule, PercentRule, DateFormatCreatedAtRule};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OfferRequestApi extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $is_create = !$request->offer?->id;
        $discount_percent = [];
        if (data_get($request, 'discount_type') === OfferDiscountTypeEnum::DISCOUNT->value) {
            $discount_percent = ['discount_percent' => ['required', new PercentRule()]];
        }
        $can_use_type = [];
        $can_use_from_date = [];
        if (data_get($request, 'discount_type') !== OfferDiscountTypeEnum::HONOR->value) {
            $can_use_type = ['can_use_type' => ['required', new Enum(OfferCanUseTypeEnum::class)]];
            if (data_get($request, 'can_use_type') === OfferCanUseTypeEnum::FROM_DATE->value) {
                $can_use_from_date = ['can_use_from_date' => ['required', new DateFormatCreatedAtRule()]];
            }
        }

        return [
            'name' => ['required', new SmallTextRule()],
            'discount_type' => ['required', new Enum(OfferDiscountTypeEnum::class)],
            ...$discount_percent,

            'show_percent' => ['required', 'gt:0', new PercentRule()],

            ...$can_use_type,
            ...$can_use_from_date,
            'valid_to_type' => ['required', new Enum(OfferValidToTypeEnum::class)],
            'max_used' => ['required', 'numeric', 'gt:0'],
            'icon' => [$is_create ? 'required' : 'nullable', new ImageRule()],
        ];
    }
}
