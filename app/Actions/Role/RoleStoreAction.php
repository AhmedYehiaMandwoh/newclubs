<?php

namespace App\Actions\Role;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\RoleRequest;
use App\Services\BouncerService;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\Role;

class RoleStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_STORE;

    public function handle(RoleRequest $request)
    {
        $validated_data = $request->validated();
        DB::beginTransaction();
        $abilities = $validated_data['abilities'] ?? [];
        $role = Role::create($validated_data);
        Bouncer::sync($role)->abilities($abilities);
        BouncerService::refresh();
        DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(): \Inertia\Response
    {
        RoleIndexAction::make()->useBreadcrumb([
            ['label' => __('base.add_new'), 'url' => route('roles.create')],
        ]);
        return Inertia::render('Role/Create', [...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {
        $abilities = Abilities::getAbilities()->groupBy('module');
        return [
            'form_data' => ['abilities' => $abilities]
        ];
    }

}
