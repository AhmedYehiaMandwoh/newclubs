<?php

namespace App\Actions\User;

use App\Classes\BaseAction;
use Illuminate\Support\Facades\Auth;

class UserLogoutAction extends BaseAction
{
    public function handle()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
