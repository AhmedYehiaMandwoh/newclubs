<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Http\Requests\Apis\ClientWinOfferRequest;
use App\Models\{ClientOffer, Offer, Setting};
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;

class ClientWinOffer extends BaseAction
{
    use ApiResponseTrait;

    public function handle(ClientWinOfferRequest $request)
    {
        $validated_data = $request->validated();
        $offer = Offer::where('id', $validated_data["offer_id"])->first();
        $offer_max_per_hour = Setting::where('key', 'offer_max_per_hour')->first();

        if (!empty($offer) && $offer->max_used !== 0) {
            $latest_client_offer = ClientOffer::where('client_id', auth()->user()->id)->latest('created_at')->first();
            if (!empty($latest_client_offer)) {
                if ($latest_client_offer->created_at->isToday()) {
                    $hoursLater = Carbon::today()->addHours((int)$offer_max_per_hour['value']);
                    $formattedTime = $hoursLater->format('Y-m-d'); // Format in desired format

                    return $this->apiResponseMobile(__('base.please_come') . " " . $formattedTime);

                }
            }

            $offerClient = new ClientOffer();
            $offerClient->client_id = auth()->user()->id;
            $offerClient->offer_id = $offer->id;
            $offerClient->branch_id = $offer->branch_id;
            $offerClient->expire_at = $offer->valid_to_date;
            $offerClient->save();

            $offer->max_used -= 1;
            $offer->save();

            return $this->apiResponseMobile(__('base.congratulation'));

        }
        return $this->apiResponseMobile(__('base.no_offer'));
    }
}
