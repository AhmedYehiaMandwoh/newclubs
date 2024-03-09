<?php

namespace App\Actions\HospitalityProviders\Dashboard\Offers;

use App\Classes\BaseAction;
use App\Models\Offer;

class OffersDeleteAction extends BaseAction
{
//    protected Abilities $ability=Abilities::;

    public function handle(Offer $offer): \Illuminate\Http\RedirectResponse
    {
        if ($offer) {

            $this->tryDelete($offer);
            return back();
        }
    }
}
