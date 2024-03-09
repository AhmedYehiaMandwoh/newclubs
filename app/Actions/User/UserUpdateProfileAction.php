<?php

namespace App\Actions\User;

use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\ProfileRequest;
use App\Services\StorageService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserUpdateProfileAction extends BaseAction
{
    public function handle(ProfileRequest $request)
    {
        $user = Auth::user();
        $validated_data = $request->validated();
        if (!data_get($validated_data, 'password'))
            unset($validated_data['password']);
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::USER_AVATAR, $request->file('avatar'), oldFileToDeletePath: $user->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $user->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(): \Inertia\Response
    {
        $this->breadcrumb([
            ['label' => __('base.edit_profile'), 'url' => route('auth.edit')],
        ]);
        $userDetails = Auth::user();
        return Inertia::render('User/AuthUserEdit', compact('userDetails'));
    }

}
