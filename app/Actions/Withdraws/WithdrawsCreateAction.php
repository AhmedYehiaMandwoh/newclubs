<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Enums\ModuleNameEnum;
use Inertia\Inertia;

class WithdrawsCreateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_CREATE;

    public function handle()
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::WITHDRAWS), 'url' => route('withdraws.index')],
            ['label' => __('base.create_withdraw'), 'url' => route('withdraws.create')],
        ]);
        return Inertia::render('Withdraws/WithdrawFormCreateUpdate');
    }

}
