<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum OfferCanUseTypeEnum: string
{
    use EnumOptionsTrait;

    case DIRECT = "direct";
    case TOMORROW_MORNING = "tomorrow_morning";
    case AFTER_ONE_DAY = "after_one_day";
    case FROM_DATE = "from_date";
}
