<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum SettingsKeysEnum: string
{
    use EnumOptionsTrait;

    case OFFER_MAX_PER_HOUR = "offer_max_per_hour";
    case WHEEL_ROTATION_TIME = "wheel_rotation_time";
    case TERMS_AND_CONDITIONS = "terms_and_conditions";
}
