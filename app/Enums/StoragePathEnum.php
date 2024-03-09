<?php

namespace App\Enums;

use Mahmoudmhamed\LaravelHelpers\Traits\EnumOptionsTrait;

enum StoragePathEnum: string
{
    use EnumOptionsTrait;
    case USER_AVATAR='user_avatar';
    case HOSPITALITY_AVATAR='hospitality_avatar';
    case CLIENT_AVATAR='client_avatar';
    case WITHDRAWS='withdraws';
    case SPONSORS='sponsors';
    case SETTINGS='settings';
    case CLIENTS='clients';
    case OFFERS='offers';
}
