<?php

namespace App\Actions\Apis\Public;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\SettingsKeysEnum;
use App\Models\Setting;

class TermsAndConditionsAction extends BaseAction
{
    public function handle()
    {
        return $this->apiSuccess([
            'terms_ad_conditions'=>Setting::query()->where('key',SettingsKeysEnum::TERMS_AND_CONDITIONS)->first()?->value
        ]);
    }
}
