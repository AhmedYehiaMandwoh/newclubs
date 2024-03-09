<?php

namespace App\Observers;

use App\Enums\OfferCanUseTypeEnum;
use App\Enums\OfferDiscountTypeEnum;
use App\Enums\OfferValidToTypeEnum;
use App\Models\Offer;
use Carbon\Carbon;

class OfferObserver
{
    /**
     * Handle the Offer "created" event.
     */
    public function created(Offer $offer): void
    {
        $this->updateDate($offer);
    }

    /**
     * Handle the Offer "updated" event.
     */
    public function updated(Offer $offer): void
    {
        $this->updateDate($offer);
    }

    private function updateDate(Offer $offer): void
    {
        $offer->valid_to_date=Carbon::create($offer->created_at)->clone()->addDays(OfferValidToTypeEnum::getValidToAddDays($offer->valid_to_type));
        if ($offer->discount_type == OfferDiscountTypeEnum::FREE)
            $offer->discount_percent=100;
        if ($offer->discount_type == OfferDiscountTypeEnum::HONOR)
            $offer->discount_percent=0;

        if ($offer->can_use_type!=OfferCanUseTypeEnum::FROM_DATE)
            $offer->can_use_from_date=null;
        $offer->saveQuietly();
    }
    /**
     * Handle the Offer "deleted" event.
     */
    public function deleted(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "restored" event.
     */
    public function restored(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "force deleted" event.
     */
    public function forceDeleted(Offer $offer): void
    {
        //
    }
}
