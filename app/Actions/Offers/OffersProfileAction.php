<?php

namespace App\Actions\Offers;

use App\Classes\{BaseAction, Abilities};
use App\Models\Offer;
use Inertia\Inertia;

class OffersProfileAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_OFFERS_MAIN_DATA;

    public function viewMainData(Offer $offer): \Inertia\Response
    {
        $this->setProfileTab('MainDataTab', $offer);
        $data['row'] = $offer;
        return Inertia::render('Offers/Profile/Index', compact('data'));
    }

    public function viewEdit(Offer $offer): \Inertia\Response
    {
        $this->setProfileTab('EditTab', $offer, __('base.edit'));
        $data = OffersIndexAction::make()->getCreateUpdateData();
        $data['row'] = $offer;
        return Inertia::render('Offers/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Offer &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('offers.profile.main-data', $row)];

        if ($title) {
            OffersIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            OffersIndexAction::make()->useBreadcrumb([$main_data_url]);
        }

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
