<?php

namespace App\Actions\Sponsors;

use App\Classes\{Abilities, BaseAction};
use App\Enums\ModuleNameEnum;
use Inertia\Inertia;

class SponsorsCreateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_CREATE;

    public function handle()
    {

        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SPONSORS), 'url' => route('sponsors.index')],
            ['label' => __('base.create_sponsor'), 'url' => route('sponsors.create')],
        ]);
        return Inertia::render('Sponsors/SponsorsFormCreateUpdate');
    }

}
