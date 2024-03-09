<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Enums\ModuleNameEnum;
use App\Models\Withdraw;
use Inertia\Inertia;

class WithdrawsIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Withdraw::query()->latest('id')->search(['name']);
        if ($this->requestIsExport(Abilities::M_WITHDRAWS_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'started_at', 'ended_at', 'created_at_text'], 'withdraws');
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Withdraws/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::WITHDRAWS), 'url' => route('withdraws.index')],
            ...$append_breadcrumb
        ]);
    }

}
