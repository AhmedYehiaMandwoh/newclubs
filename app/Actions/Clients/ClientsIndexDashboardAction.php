<?php

namespace App\Actions\Clients;

use App\Classes\{Abilities, BaseAction};
use App\Enums\{IsActiveEnum, ModuleNameEnum};
use App\Models\Client;
use Inertia\Inertia;

class ClientsIndexDashboardAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_CLIENTS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = Client::query()->latest('id')->search(['name']);
        if ($this->requestIsExport(Abilities::M_CLIENTS_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'email', 'phone', 'is_active', 'created_at_text'], 'clients');
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('Clients/Index', ['data' => $data, ...$this->getCreateUpdateData()]);

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
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CLIENTS), 'url' => route('clients.index')],
            ...$append_breadcrumb
        ]);
    }


}
