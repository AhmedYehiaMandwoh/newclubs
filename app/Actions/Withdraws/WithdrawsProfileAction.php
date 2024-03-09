<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Models\{ClientOffer, Withdraw};
use Inertia\Inertia;

class WithdrawsProfileAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_MAIN_DATA;

    public function viewMainData(Withdraw $withdraw): \Inertia\Response
    {
        $this->setProfileTab('MainDataTab', $withdraw);
        $data['row'] = $withdraw;
        return Inertia::render('Withdraws/Profile/Index', compact('data'));
    }

    public function viewEdit(Withdraw $withdraw): \Inertia\Response
    {
        $this->setProfileTab('EditTab', $withdraw, __('base.edit'));
        $data['row'] = $withdraw;
        return Inertia::render('Withdraws/Profile/Index', compact('data'));
    }

    public function showClients(Withdraw $withdraw): \Inertia\Response
    {
        $this->setProfileTab('TabClientsData', $withdraw, __('base.clients'));
        $query = ClientOffer::query()->latest('id')->with('user', "offer")->search(['user.name']);
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Withdraws/Profile/Index', ['data' => $data]);
    }

    public function setProfileTab($tap_component, Withdraw &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('withdraws.profile.main-data', $row)];

        if ($title) {
            WithdrawsIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            WithdrawsIndexAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
