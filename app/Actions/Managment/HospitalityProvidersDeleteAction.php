<?php

namespace App\Actions\Managment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\HospitalityProvider;
use Illuminate\Support\Facades\Auth;

class HospitalityProvidersDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_hospitality_providers_DELETE;

    public function handle(HospitalityProvider $user): \Illuminate\Http\RedirectResponse
    {
        if ($user->id == Auth::id()) {
            $this->makeErrorSessionMessage(__('message.cant_delete_you_account'));
            return back();
        }
        $this->tryDelete($user);
        return back();
    }
}
