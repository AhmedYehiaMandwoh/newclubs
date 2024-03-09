<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\StoragePathEnum;
use App\Http\Requests\Apis\ApiUpdateAuthRequest;
use App\Http\Resources\ClientProviderResource;
use App\Services\StorageService;

class ClientsUpdateAction extends BaseAction
{
    public function handle(ApiUpdateAuthRequest $request)
    {
        $user = Helpmate::getApiAuth();
        $validated_data = $request->validated();
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload($user->type=='client'?StoragePathEnum::CLIENTS:StoragePathEnum::HOSPITALITY_AVATAR, $request->file('avatar'), oldFileToDeletePath: $user->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $user->update($validated_data);
        return $this->apiResponseMobile(__('base.updated_successfully'), ["user" => new ClientProviderResource($user)]);
    }
}
