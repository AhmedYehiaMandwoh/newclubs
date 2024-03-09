<?php

namespace App\Models\Builders;

use App\Enums\ClientOfferStatusEnum;
use App\Models\ClientOffer;
use Carbon\Carbon;

/**
 * @mixin ClientOffer
 */
class ClientOfferBuilder extends BaseBuilder
{

    public function status(ClientOfferStatusEnum $status = null)
    {
        if (!$status)
            return $this;
        if ($status == ClientOfferStatusEnum::USED) {
            return $this->whereNotNull('used_at');
        }

        if ($status == ClientOfferStatusEnum::NEW) {
            return $this->canUse()->isNew(true);
        }
        if ($status == ClientOfferStatusEnum::SAVED) {
            return $this->canUse()->isNew(false);
        }
        if ($status == ClientOfferStatusEnum::ENDED) {
            return $this->isEnded();
        }

    }

    public function canUse(): ClientOfferBuilder
    {
        return $this->whereNull('used_at')->where('expire_at', '>', Carbon::now());
    }

    public function isEnded(): ClientOfferBuilder
    {
        return $this->whereNull('used_at')->where('expire_at','<',Carbon::now());
    }

    public function isNew($is_new=true): ClientOfferBuilder
    {
        return $this->where('created_at', $is_new?'>':'<=', Carbon::now()->subHour(24));
    }
}
