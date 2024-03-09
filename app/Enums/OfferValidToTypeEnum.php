<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum OfferValidToTypeEnum: string
{
    use EnumOptionsTrait;

    case DAY = "day";
    case WEEK = "week";
    case MONTH = "month";
    case TWO_MONTHS = "two_months";
    case THREE_MONTHS = "three_months";
    case SIX_MONTHS = "six_months";


    public static function getValidToAddDays(self $case): int
    {
        if ($case == self::DAY)
            return 1;
        if ($case == self::WEEK)
            return 7;
        if ($case == self::MONTH)
            return 30;
        if ($case == self::TWO_MONTHS)
            return 60;
        if ($case == self::THREE_MONTHS)
            return 90;
        return 180;
    }
}
