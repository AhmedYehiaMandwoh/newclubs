<?php

namespace App\Actions\Offers;

use App\Classes\{BaseAction, Abilities};
use App\Models\Offer;

class OffersDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_DELETE;

    public function handle(Offer $offer): \Illuminate\Http\RedirectResponse
    {
        if ($offer) {

            $this->tryDelete($offer);
            return back();
        }
    }
}
