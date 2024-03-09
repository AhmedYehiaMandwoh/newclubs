<?php

namespace App\Actions\Clients;

use App\Classes\{Abilities, BaseAction};
use App\Enums\StoragePathEnum;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\StorageService;

class ClientsUpdateDashboardAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_CLIENTS_UPDATE;

    public function handle(Client $client, ClientRequest $request)
    {
        $validated_data = $request->validated();
        if (data_get($validated_data, 'avatar')) {
            $validated_data['avatar'] = StorageService::publicUpload(StoragePathEnum::CLIENTS, $request->file('avatar'), oldFileToDeletePath: $client->avatar);
        } else {
            unset($validated_data['avatar']);
        }
        $client->update($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}
