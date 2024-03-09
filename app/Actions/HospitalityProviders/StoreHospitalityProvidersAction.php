<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\HospitalityProvidersRequest;
use App\Models\HospitalityProvider;
use App\Services\StorageService;

class StoreHospitalityProvidersAction extends BaseAction
{


    public function handle(HospitalityProvidersRequest $request)
    {
        $validated_data = $request->validated();
        if (data_get($request, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::HOSPITALITY_AVATAR, $request->file('avatar'));
        }
        HospitalityProvider::create($validated_data);

        $this->makeSuccessSessionMessage();
        return redirect()->route('hospitality_providers.HospitalityProvidersLogin');


    }
}
