<?php

namespace App\Actions\Apis\HospitalityProviders\Offers;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\OfferCanUseTypeEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Enums\OfferValidToTypeEnum;
use App\Enums\StoragePathEnum;
use App\Http\Requests\Apis\OfferRequestApi;
use App\Models\{Branch, Offer};
use App\Services\StorageService;

class StoreOffersAction extends BaseAction
{
    public function handle(Branch $branch, OfferRequestApi $request)
    {
        abort_if($branch->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        $validated_data = $request->validated();
        $validated_data['branch_id'] = $branch->id;
        if (data_get($validated_data, 'icon')) {
            $validated_data['icon'] = StorageService::publicUpload(StoragePathEnum::OFFERS, $request->file('icon'));
        }

        Offer::query()->create($validated_data);
        return $this->apiSuccessMessage();
    }

    public function getCreateUpdateData(): \Illuminate\Http\JsonResponse
    {
        return $this->apiSuccess([
            'discount_type' => OfferDiscountTypeEnum::getOptionsData(),
            'can_use_type' => OfferCanUseTypeEnum::getOptionsData(),
            'valid_to_type' => OfferValidToTypeEnum::getOptionsData(),
        ]);
    }
}


