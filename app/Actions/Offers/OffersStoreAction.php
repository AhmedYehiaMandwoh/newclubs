<?php

namespace App\Actions\Offers;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\StoragePathEnum;
use App\Http\Requests\OfferManagementRequest;
use App\Models\{Offer};
use App\Services\StorageService;
use Carbon\Carbon;
class OffersStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_OFFERS_CREATE;

    public function handle(OfferManagementRequest $request)
    {
        $valid = $request->validated();
        $valid['hospitality_provider_id'] = Helpmate::getAuthHospitalityProvider()?->id;

        if (data_get($valid,'icon')) {
            $valid['icon'] = StorageService::publicUpload(StoragePathEnum::OFFERS, $request->file('icon'));
        }
        if ($valid['can_use_type'] !== 'in_date') {
            $valid['can_use_from_date'] = Carbon::now()->add(
                match ($valid['can_use_type']) {
                    'tomorrow_morning' => '1 day',
                    'after_one_day' => '1 day',
                    'direct' => '1 day',

                }
            );
        } else {
            $valid['can_use_from_date'] = Carbon::parse($valid['can_use_from_date']);

        }
        $valid['valid_to_date'] = Carbon::now()->add(
            match ($valid['valid_to_type']) {
                'day' => '1 day',
                'week' => '1 week',
                'month' => '1 month',
                'two_months' => '2 months',
                'three_months' => '3 months',
                'six_months' => '6 months',
                default => null,
            }
        );

        Offer::query()->create($valid);
        $this->makeSuccessSessionMessage();
        return back();
    }
}


