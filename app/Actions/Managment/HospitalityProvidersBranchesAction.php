<?php

namespace App\Actions\Managment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\IsActiveEnum;
use App\Enums\ModuleNameEnum;
use App\Models\{Branch, HospitalityProvider};
use Inertia\Inertia;

class HospitalityProvidersBranchesAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_HospitalityProviders_BRANCHES;

    public function handle(HospitalityProvider $HospitalityProviders): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Branch::query()->where('hospitality_provider_id', $HospitalityProviders->id)->search(['name', 'email']);
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Managment/Branches', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {

        return [
            'form_data' => [
                'status' => IsActiveEnum::getOptionsData(),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::hospitality_providers), 'url' => route('hospitalityproviders.index')],
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BRANCHES)],
            ...$append_breadcrumb
        ]);
    }
}
