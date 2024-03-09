<?php

namespace App\Actions\Apis\Clients;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Resources\ClientProviderResource;

class ClientsUserAction extends BaseAction
{
    public function handle()
    {
        $user = Helpmate::getApiAuth();
        return $this->apiSuccess(["user" => ClientProviderResource::make($user)]);
    }
}
