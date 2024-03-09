<?php

namespace App\Actions\Settings;

use App\Classes\{Abilities, BaseAction};
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingsUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SETTINGS_UPDATE;

    public function handle(Setting $setting, SettingRequest $request)
    {
        $validated_data = $request->validated();
        $setting->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}
