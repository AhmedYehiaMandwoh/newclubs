<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\BouncerService;
use App\Services\StorageService;

class UserUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_UPDATE;

    public function handle(User $user, UserRequest $request)
    {
        $validated_data = $request->validated();
        if (!data_get($validated_data, 'password'))
            unset($validated_data['password']);
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::USER_AVATAR, $request->file('avatar'), oldFileToDeletePath: $user->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $user->update($validated_data);
        $user->roles()->detach();
        data_get($request, 'role') && $user->assign($validated_data['role']);
        BouncerService::refresh();
        $this->makeSuccessSessionMessage();
        return back();
    }
}
