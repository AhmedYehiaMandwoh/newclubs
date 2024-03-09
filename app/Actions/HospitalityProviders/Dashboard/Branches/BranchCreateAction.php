<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use Inertia\Inertia;

class BranchCreateAction extends BaseAction
{
//    protected Abilities $ability=Abilities::;

    public function handle()
    {

        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BRANCHES), 'url' => route('hospitality_providers.branches.index')],
            ['label' => __('base.create_branch'), 'url' => route('hospitality_providers.branches.create')],
        ]);
        $data = BranchIndexAction::make()->getCreateUpdateData();
        return Inertia::render('HospitalityProviders/Branches/Profile/EditTab', compact('data'));
    }

}
