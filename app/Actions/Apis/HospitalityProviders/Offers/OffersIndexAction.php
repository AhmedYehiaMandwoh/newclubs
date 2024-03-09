<?php

namespace App\Actions\Apis\HospitalityProviders\Offers;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Resources\OfferResource;
use App\Models\Branch;
use App\Models\Offer;

class OffersIndexAction extends BaseAction
{
    public function handle(Branch $branch): \Illuminate\Http\JsonResponse
    {
        abort_if($branch->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        $offers = Offer::query()->where('branch_id', $branch->id)->latest('id')->paginate();
        return $this->apiSuccess([
            'branches' => OfferResource::collection($offers)->response()->getData(true)
        ]);
    }
}
