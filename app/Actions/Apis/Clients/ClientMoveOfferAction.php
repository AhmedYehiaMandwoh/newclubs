<?php

namespace App\Actions\Apis\Clients;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\ClientOfferStatusEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Models\Client;
use App\Models\ClientOffer;
use App\Models\HospitalityProvider;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\ActionRequest;

class ClientMoveOfferAction extends BaseAction
{
    public function rules()
    {
        return [
            'email_or_phone' => 'required',
        ];
    }

    public function handle(ClientOffer $clientOffer, ActionRequest $request)
    {
        $email_or_phone = $request->validated()['email_or_phone'];
        $auth_client = Helpmate::getApiAuthTypeClient();
        abort_if(
            $auth_client->id != $clientOffer->client_id ||
            $clientOffer->offer->discount_type == OfferDiscountTypeEnum::HONOR
            , 404);
        if (in_array($clientOffer->status, [ClientOfferStatusEnum::ENDED, ClientOfferStatusEnum::USED])) {
            throw ValidationException::withMessages(['offer_id' => __('base.cant_dedication_this_gift')]);
        }

        $user = Client::query()
            ->where('email', $email_or_phone)
            ->where('id', '!=', $auth_client->id)
            ->orWhere('phone', $email_or_phone)->first();
        if (!$user) {
            throw ValidationException::withMessages(['email_or_phone' => __('validation.email_or_phone')]);
        }
        $clientOffer->update([
            'from_client_id' => $clientOffer->client_id,
            'client_id' => $user->id
        ]);
        return ClientOffersAction::make()->handle($request);
    }
}
