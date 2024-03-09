<?php

namespace App\Actions\Clients;

use App\Classes\{Abilities, BaseAction};
use App\Models\Client;
use Inertia\Inertia;

class ClientsProfileDashboardAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_CLIENTS_MAIN_DATA;

    public function viewMainData(Client $client): \Inertia\Response
    {
        $this->setProfileTab('MainDataTab', $client);
        $data['row'] = $client;
        return Inertia::render('Clients/Profile/Index', compact('data'));
    }

    public function viewEdit(Client $client): \Inertia\Response
    {
        $this->setProfileTab('EditTab', $client, __('base.edit'));
        $data = ClientsIndexDashboardAction::make()->getCreateUpdateData();
        $data['row'] = $client;
        return Inertia::render('Clients/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Client &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('clients.profile.main-data', $row)];

        if ($title) {
            ClientsIndexDashboardAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            ClientsIndexDashboardAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
