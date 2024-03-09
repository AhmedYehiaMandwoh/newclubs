<?php

namespace App\Actions\HospitalityProviders\Dashboard;

use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\ProfileHospitalityProvidersRequest;
use App\Services\StorageService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HospitalityProvidersUpdateProfileAction extends BaseAction
{
    public function handle(ProfileHospitalityProvidersRequest $request)
    {
        $user = Auth::guard('hospitality_provider')->user();
        $validated_data = $request->validated();
        if (!data_get($validated_data, 'password'))
            unset($validated_data['password']);
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::HOSPITALITY_AVATAR, $request->file('avatar'), oldFileToDeletePath: $user->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $user->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(): \Inertia\Response
    {
        $data['userDetails'] = Auth::guard('hospitality_provider')->user();
        $this->breadcrumb([
            ['label' => __('base.edit_profile'), 'url' => route('hospitality_providers.profile.edit', $data['userDetails']->id)],
        ]);

        return Inertia::render('HospitalityProviders/Dashboard/HospitalityProvidersProfileEdit', compact('data'));
    }

}
