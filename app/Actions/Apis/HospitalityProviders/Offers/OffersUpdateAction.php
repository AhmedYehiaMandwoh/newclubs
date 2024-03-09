<?php

namespace App\Actions\Apis\HospitalityProviders\Offers;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\StoragePathEnum;
use App\Http\Requests\Apis\OfferRequestApi;
use App\Models\{Offer};
use App\Services\StorageService;
use App\Traits\ApiResponseTrait;

class OffersUpdateAction extends BaseAction
{
    use ApiResponseTrait;

    public function handle(Offer $offer, OfferRequestApi $request)
    {
        abort_if($offer->branch?->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        $validated_data = $request->validated();
        if (data_get($validated_data, 'icon')) {
            $validated_data['icon'] = StorageService::publicUpload(StoragePathEnum::OFFERS, $request->file('icon'),oldFileToDeletePath: $offer->icon);
        }else{
            unset($validated_data['icon']);
        }
        $offer->update($validated_data);
        return $this->apiSuccessMessage();
    }
}
