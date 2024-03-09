<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum ClientOfferStatusEnum: string
{
    use EnumOptionsTrait;

    case USED='used';
    case SAVED='saved';
    case ENDED='ended';
    case NEW='NEW';
}
