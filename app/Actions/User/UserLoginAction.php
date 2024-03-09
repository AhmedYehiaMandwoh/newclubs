<?php

namespace App\Actions\User;

use App\Classes\BaseAction;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class UserLoginAction extends BaseAction
{

    public function handle(UserLoginRequest $request)
    {
        if (!Auth::attempt(array_merge($request->only('email', 'password'), ['is_active' => true]), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        return Redirect::route('home');
    }

    public function loginForm(): Response|\Inertia\ResponseFactory
    {
        $this->pageTitle(__('base.login'));
        return inertia('User/Login');
    }
}
