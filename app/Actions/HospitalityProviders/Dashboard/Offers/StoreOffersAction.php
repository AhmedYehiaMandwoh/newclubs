<?php

namespace App\Actions\HospitalityProviders\Dashboard\Offers;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\StoragePathEnum;
use App\Http\Requests\OfferRequest;
use App\Models\{Offer};
use App\Services\StorageService;
use Carbon\Carbon;

class StoreOffersAction extends BaseAction
{
    public function handle(OfferRequest $request)
    {
        $valid = $request->validated();
        $valid['hospitality_provider_id'] = Helpmate::getAuthHospitalityProvider()?->id;

        if (data_get($valid, 'avatar')) {
            $valid['avatar'] = StorageService::publicUpload(StoragePathEnum::OFFERS, $request->file('avatar'));
        }
        $valid['valid_to_date'] = Carbon::parse($valid['valid_to_date']);
        $valid['can_use_type_date'] = Carbon::now()->add(
            match ($valid['can_use_type']) {
                'day' => '1 day',
                'week' => '1 week',
                'month' => '1 month',
                'two_months' => '2 months',
                'three_months' => '3 months',
                'six_months' => '6 months',
                default => null,
            }
        );
        if ($valid['valid_to_type'] !== 'in_date') {
            $valid['valid_to_date'] = Carbon::now()->add(
                match ($valid['valid_to_type']) {
                    'tomorrow_morning' => '1 day',
                    'after_one_day' => '1 day',
                    'in_date' => '1 day',
                    'direct' => '1 day',
                }
            );
        } else {
            $valid['valid_to_date'] = Carbon::parse($valid['valid_to_date']);

        }

        Offer::query()->create($valid);
        $this->makeSuccessSessionMessage();
        return back();
    }
}


