<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum IsActiveEnum: int
{
    use EnumOptionsTrait;

    case ACTIVE = 1;
    case NOT_ACTIVE = 0;
}
