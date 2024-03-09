<?php

namespace App\Actions\Sponsors;


use App\Classes\{Abilities, BaseAction};
use App\Enums\{IsActiveEnum, ModuleNameEnum};
use App\Models\Sponsor;
use Inertia\Inertia;

class SponsorsIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Sponsor::query()->latest('id')->search(['name']);
        if ($this->requestIsExport(Abilities::M_SPONSORS_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'is_active', 'created_at_text'], 'sponsors');
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Sponsors/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {

        return [
            'form_data' => [
                'is_active' => IsActiveEnum::getOptionsData(),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SPONSORS), 'url' => route('sponsors.index')],
            ...$append_breadcrumb
        ]);
    }


}
