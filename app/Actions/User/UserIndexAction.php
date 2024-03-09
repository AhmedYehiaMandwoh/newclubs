<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\IsActiveEnum;
use App\Enums\ModuleNameEnum;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;

class UserIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = User::query()->latest('id')->search(['name', 'email'])->with('roles');
        if ($this->requestIsExport(Abilities::M_USERS_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'email', 'is_active', 'created_at_text'], 'users');
        }
        $data = $query->paginate($this->getPaginateLength());
        return Inertia::render('User/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {
        $roles = Role::all(['id', 'name']);
        return [
            'form_data' => [
                'roles' => $roles,
                'is_active' => IsActiveEnum::getOptionsData(),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS), 'url' => route('users.index')],
            ...$append_breadcrumb
        ]);
    }
}
