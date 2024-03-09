<?php

namespace App\Actions\Managment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\ProfileHospitalityProvidersRequest;
use App\Models\HospitalityProvider;
use App\Services\StorageService;

class HospitalityProvidersUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_HospitalityProviders_UPDATE;

    public function handle(HospitalityProvider $HospitalityProviders, ProfileHospitalityProvidersRequest $request)
    {
        $validated_data = $request->validated();
        if (!data_get($validated_data, 'password'))
            unset($validated_data['password']);
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::HOSPITALITY_AVATAR, $request->file('avatar'), oldFileToDeletePath: $user->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $HospitalityProviders->is_active = $validated_data['is_active'];
        $HospitalityProviders->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}
