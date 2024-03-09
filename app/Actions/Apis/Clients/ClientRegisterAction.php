<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Enums\StoragePathEnum;
use App\Http\Requests\Apis\ClientApiRegisterRequest;
use App\Http\Resources\ClientProviderResource;
use App\Models\Client;
use App\Services\StorageService;

class ClientRegisterAction extends BaseAction
{
    public function handle(ClientApiRegisterRequest $request)
    {
        $validated_data = $request->validated();
        if (data_get($validated_data,'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::CLIENT_AVATAR, $request->file('avatar'));
        }
        $client = Client::create($validated_data);
        return $this->apiResponseMobile(__('base.register_successfully'), [
            'user' => ClientProviderResource::make($client),
            'token' => $client->createToken('client-token')->plainTextToken,
        ]);
    }
}
