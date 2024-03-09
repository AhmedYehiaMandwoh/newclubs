<?php

namespace App\Actions\Managment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\{HospitalityProviderTypesEnum, IsActiveEnum, ModuleNameEnum};
use App\Models\HospitalityProvider;
use App\Models\Role;
use Inertia\Inertia;

class HospitalityProvidersIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_HospitalityProviders_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = HospitalityProvider::query()->latest('id')->search(['name', 'email']);
        if ($this->requestIsExport(Abilities::M_HospitalityProviders_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'phone', 'email', 'is_active', 'created_at_text'], 'hospitality_providers');
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Managment/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {
        $roles = Role::all(['id', 'name']);
        return [
            'form_data' => [
                'roles' => $roles,
                'is_active' => IsActiveEnum::getOptionsData(),
                'types' => HospitalityProviderTypesEnum::getOptionsData(),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::hospitality_providers), 'url' => route('hospitalityproviders.index')],
            ...$append_breadcrumb
        ]);
    }
}
