<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Http\Requests\HospitalityProvidersLoginRequest;
use App\Models\HospitalityProvider;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;


class LoginHospitalityProvidersAction extends BaseAction
{

    public function handle(HospitalityProvidersLoginRequest $request)
    {
        $user = HospitalityProvider::where('email', $request->email)->where('is_active', true)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);

        } else {

            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember_me');
            if (Auth::guard('hospitality_provider')->attempt($credentials, $remember)) {
                return Redirect::route('hospitality_providers.homeHospitalityProviders');
            }
        }
    }
}
