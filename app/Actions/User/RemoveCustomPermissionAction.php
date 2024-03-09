<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\User;
use App\Services\BouncerService;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RemoveCustomPermissionAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_ADD_CUSTOM_ABILITY;

    public function rules(): array
    {
        return [
            'name' => Rule::in(collect(Abilities::PERMISSIONS)->pluck('key.value')->toArray()),
        ];
    }

    public function handle(User $user, ActionRequest $request)
    {
        Bouncer::disallow($user)->to(data_get($request, 'name'));
        BouncerService::refresh();
        $this->makeSuccessSessionMessage();
        return back();
    }
}
