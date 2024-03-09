<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Models\{HospitalityProvider, PasswordReset};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class ResetHospitalityProvidersPasswordAction extends BaseAction
{
    private $HospitalityProviders = null;

    public function handle(Request $request): Response|\Inertia\ResponseFactory
    {

        if (Auth::guard('hospitality_provider')->user()) {
            return inertia('HospitalityProviders/home');
        }
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'DESC')->first();

        if ($reset) {
            $this->HospitalityProviders = HospitalityProvider::where('email', $reset->email)->first();
        }

        return inertia('HospitalityProviders/ChangePassword', compact('reset'));

    }
}
