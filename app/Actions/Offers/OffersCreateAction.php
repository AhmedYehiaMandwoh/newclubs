<?php

namespace App\Actions\Offers;

use App\Classes\{BaseAction, Abilities};
use Inertia\Inertia;
use App\Enums\ModuleNameEnum;

class OffersCreateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_OFFERS_CREATE;

    public function handle()
    {

        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::OFFERS), 'url' => route('offers.index')],
            ['label' => __('base.create_offer'), 'url' => route('offers.create')],
        ]);
        $data = OffersIndexAction::make()->getCreateUpdateData();
        return Inertia::render('Offers/Profile/EditTab', compact('data'));

    }

}
