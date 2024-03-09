<?php

namespace App\Actions\Sponsors;

use App\Classes\{Abilities, BaseAction};
use App\Models\Sponsor;
use Inertia\Inertia;

class SponsorsProfileAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_MAIN_DATA;

    public function viewMainData(Sponsor $sponsor): \Inertia\Response
    {
        $this->setProfileTab('MainDataTab', $sponsor);
        $data['row'] = $sponsor;
        return Inertia::render('Sponsors/Profile/Index', compact('data'));
    }

    public function viewEdit(Sponsor $sponsor): \Inertia\Response
    {
        $this->setProfileTab('EditTab', $sponsor, __('base.edit'));
        $data = SponsorsIndexAction::make()->getCreateUpdateData();
        $data['row'] = $sponsor;
        return Inertia::render('Sponsors/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Sponsor &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('sponsors.profile.main-data', $row)];

        if ($title) {
            SponsorsIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            SponsorsIndexAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
