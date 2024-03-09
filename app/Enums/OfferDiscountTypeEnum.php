<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum OfferDiscountTypeEnum: string
{
    use EnumOptionsTrait;

    case DISCOUNT = "discount";
    case FREE = "free";
    case HONOR = "honor";
}
