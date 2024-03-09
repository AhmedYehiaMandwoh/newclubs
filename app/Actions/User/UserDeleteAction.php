<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_DELETE;

    public function handle(User $user): \Illuminate\Http\RedirectResponse
    {
        if ($user->id == Auth::id()) {
            $this->makeErrorSessionMessage(__('message.cant_delete_you_account'));
            return back();
        }
        $this->tryDelete($user);
        return back();
    }
}
