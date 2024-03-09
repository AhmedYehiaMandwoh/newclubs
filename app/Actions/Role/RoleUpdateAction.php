<?php

namespace App\Actions\Role;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Exceptions\NotAuthorizedException;
use App\Http\Requests\RoleRequest;
use App\Services\BouncerService;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\Role;

class RoleUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_UPDATE;

    public function handle(Role $role, RoleRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated_data = $request->validated();
        DB::beginTransaction();
        $role->update($validated_data);
        Bouncer::sync($role)->abilities($validated_data['abilities'] ?? []);
        BouncerService::refresh();
        DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    /**
     * @throws NotAuthorizedException
     */
    public function viewForm(Role $role): \Inertia\Response
    {
        $this->checkAbility($this->ability);
        RoleIndexAction::make()->useBreadcrumb([
            ['label' => __('base.edit'), 'url' => route('roles.edit', $role)],
        ]);
        $role['abilities_name'] = $role->abilities->pluck('name');
        return Inertia::render('Role/Edit', ['row' => $role, ...RoleStoreAction::make()->getCreateUpdateData()]);
    }
}
