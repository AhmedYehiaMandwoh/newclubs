<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\ClientOfferStatusEnum;
use App\Http\Resources\ClientOfferResource;
use App\Models\{ClientOffer};
use App\Traits\ApiResponseTrait;
use Lorisleiva\Actions\ActionRequest;


class ClientOffersAction extends BaseAction
{
    use ApiResponseTrait;

    public function handle(ActionRequest $request)
    {
        $status=ClientOfferStatusEnum::convertStringToEnum(data_get($request,'status'));
        $client_offers=ClientOffer::query()
            ->with('offer','branch','branch.hospitalityProvider')
            ->where('client_id',Helpmate::getApiAuthTypeClient()->id)
            ->latest('id')
            ->status($status)
            ->paginate();
        return $this->apiSuccess([
            'client_offers'=>ClientOfferResource::collection($client_offers)->response()->getData(true)
        ]);
    }
}
