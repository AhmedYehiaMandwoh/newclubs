<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\OfferDiscountTypeEnum;
use App\Enums\OfferValidToTypeEnum;
use App\Http\Resources\ClientOfferResource;
use App\Http\Resources\OfferResource;
use App\Services\ClientService;
use Carbon\Carbon;
use App\Models\{ClientOffer, Offer};
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ClientsOwnedWheelOffersAction extends BaseAction
{
    use ApiResponseTrait;

    public function handle(Request $request)
    {
        $can_take_gift = (new ClientService())->canTakeGift(Helpmate::getApiAuthTypeClient());

        $offer_ids = Session::get('win_offer_ids');
        if (!$offer_ids)
            $offer_ids = [data_get($request, 'offer_id')];
        $offers = Offer::query()->whereIn('id', $offer_ids)
            ->canWin()
            ->get();
        abort_if(!$offers, 404);
        $client = Helpmate::getApiAuthTypeClient();
        $client_offers_ids = [];
        DB::beginTransaction();
        foreach ($offers as $offer) {
            $client_offers_ids[] = ClientOffer::create([
                'offer_id' => $offer->id,
                'client_id' => $client->id,
                'branch_id' => $offer->branch_id,
                'allow_use_form' => $offer->can_use_from_date ?? Carbon::now(),
                'expire_at' => Carbon::now()->addDays(OfferValidToTypeEnum::getValidToAddDays($offer->valid_to_type)),
            ])->id;
            $offer->update([
                'count_used' => $offer->count_used + 1,
            ]);
        }

        DB::commit();
        $clientOffers = ClientOffer::whereIn('id', $client_offers_ids)
            ->with('offer.branch.hospitalityProvider')
            ->get();

        return $this->apiSuccess([
            'title' => __('base.you_win_number_gifts', ['number' => count($clientOffers)]),
            'gifts' => ClientOfferResource::collection($clientOffers),
            'can_rotate' => $can_take_gift['allow_take_gift'],
            'rotate_waiting_by_hour' => $can_take_gift['waiting_by_hour'],
            'rotate_message' => $can_take_gift['allow_take_gift'] ? null : __('base.please_wait_for_before_try_again', ['number' => $can_take_gift['waiting_by_hour']]),
        ]);

    }
}
