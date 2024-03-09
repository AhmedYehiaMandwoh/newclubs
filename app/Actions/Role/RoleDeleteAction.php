<?php

namespace App\Actions\Role;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Role;
use App\Services\BouncerService;

class RoleDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_DELETE;

    public function handle(Role $role)
    {
        if (count($role->users)) {
            $this->makeErrorCantDeleteMessage();
            return back();
        }
        $this->tryDelete($role);
        BouncerService::refresh();
        return back();
    }
}
