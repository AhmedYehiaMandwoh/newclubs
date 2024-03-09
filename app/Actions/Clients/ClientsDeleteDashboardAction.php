<?php

namespace App\Actions\Clients;

use App\Classes\{Abilities, BaseAction};
use App\Models\Client;

class ClientsDeleteDashboardAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_CLIENTS_DELETE;

    public function handle(Client $client): \Illuminate\Http\RedirectResponse
    {
        if ($client) {

            $this->tryDelete($client);
            return back();
        }
    }
}
