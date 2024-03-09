<?php

namespace App\Actions\Role;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Role;
use Inertia\Inertia;

class RoleIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_INDEX;

    public function handle(): \Symfony\Component\HttpFoundation\BinaryFileResponse|\Inertia\Response
    {
        $query = Role::withCount('users', 'abilities')->latest('id')->search(['name']);
        if ($this->requestIsExport(Abilities::M_ROLES_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'users_count', 'abilities_count'], 'roles');
        }
        $data = $query->paginate($this->getPaginateLength());
        $this->useBreadcrumb();
        $this->allowSearch();
        return Inertia::render('Role/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS), 'url' => route('users.index')],
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::ROLES), 'url' => route('roles.index')],
            ...$append_breadcrumb
        ]);
    }
}
