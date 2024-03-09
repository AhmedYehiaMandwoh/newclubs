<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\User;
use App\Services\BouncerService;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserEditCustomPermissionAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_ADD_CUSTOM_ABILITY;

    public function rules(ActionRequest $request): array
    {
        $abilities = Abilities::getAbilities()->pluck('key')->toArray();
        return [
            'abilities' => ['array', 'min:1'],
            'abilities.*' => [Rule::in($abilities), 'required']
        ];
    }

    public function handle(User $user, ActionRequest $request)
    {
        $validated_data = $request->validated();
        Bouncer::sync($user)->abilities($validated_data['abilities']);
        BouncerService::refresh();
        $this->makeSuccessSessionMessage();
        return back();
    }
}
