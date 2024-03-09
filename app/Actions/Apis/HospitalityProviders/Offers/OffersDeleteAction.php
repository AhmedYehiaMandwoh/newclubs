<?php

namespace App\Actions\Apis\HospitalityProviders\Offers;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Models\Offer;

class OffersDeleteAction extends BaseAction
{
    public function handle(Offer $offer)
    {
        abort_if($offer->branch?->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        if ($this->tryDelete($offer, false)) {
            return $this->apiSuccessMessage();
        }
        return $this->apiCantDelete();
    }
}
