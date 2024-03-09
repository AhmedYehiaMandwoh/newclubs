<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum HospitalityProviderTypesEnum: string
{
    use EnumOptionsTrait;

    case RESTAURANT = 'restaurant';
    case HOTEL = 'hotel';
    case EXHIBITION = 'exhibition';
    case CAFE = 'cafe';
}
