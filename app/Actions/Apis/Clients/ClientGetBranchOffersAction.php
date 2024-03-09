<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\OfferDiscountTypeEnum;
use App\Services\ClientService;
use Carbon\Carbon;
use App\Http\Resources\{BranchResource, HospitalityProviderResource, OfferResource, ProviderResource};
use App\Models\{Branch, HospitalityProvider, Offer};
use Illuminate\Support\Facades\Session;

class ClientGetBranchOffersAction extends BaseAction
{
    public function handle(Branch $branch)
    {
        abort_if(!$branch->hospitalityProvider?->is_active, 404);
        $can_take_gift = (new ClientService())->canTakeGift(Helpmate::getApiAuthTypeClient());
        if (!$can_take_gift['allow_take_gift']) {
            return $this->apiError(message: __('base.please_wait_for_before_try_again', ['number' => $can_take_gift['waiting_by_hour']]));
        }
        $offers = Offer::query()
            ->canWin()->branchId($branch->id)
            ->inRandomOrder()
            ->get();
        $win_offer_id = $offers->first()?->id;
        Session::put('win_offer_ids', [$win_offer_id]);
        $message = null;
        if (!count($offers)){
            $message=__('base.no_offer_available_now');
        }
        return $this->apiSuccess([
            'offers' => OfferResource::collection($offers),
            'branch' => BranchResource::make($branch),

            'win_offer_id' => $win_offer_id,
            'message' => $message,
        ]);
    }
}
