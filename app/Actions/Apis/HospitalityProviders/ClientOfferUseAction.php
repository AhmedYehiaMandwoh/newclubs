<?php

namespace App\Actions\Apis\HospitalityProviders;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\OfferDiscountTypeEnum;
use App\Models\ClientOffer;
use Carbon\Carbon;

class ClientOfferUseAction extends BaseAction
{
    public function handle(ClientOffer $clientOffer)
    {
        $auth_provider=Helpmate::getApiAuthTypeHospitality();
        abort_if($auth_provider->id!=$clientOffer->branch->hospitality_provider_id || $clientOffer->used_at,404);

        abort_if($clientOffer->offer->discount_type==OfferDiscountTypeEnum::HONOR,404);
        abort_if(!$clientOffer->can_use,404);


        $clientOffer->update([
            'used_at'=>Carbon::now()
        ]);
        return $this->apiSuccessMessage();
    }
}
