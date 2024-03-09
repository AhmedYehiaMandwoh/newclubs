<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Http\Requests\ChangeRequest;
use App\Models\{HospitalityProvider, PasswordReset};

class NewHospitalityProvidersPasswordAction extends BaseAction
{

    public function handle(ChangeRequest $request)
    {
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'DESC')->first();
        if (isset($reset)) {

            $HospitalityProviders = HospitalityProvider::where('email', $reset->email)->first();
            $HospitalityProviders->update(['password' => bcrypt($request->password)]);
            $this->makeSuccessSessionMessage(__('base.password_changed_success'));
            if (isset($request->email)) {
                PasswordReset::where('email', $request->email)->delete();
            }
            return redirect()->route('hospitality_providers.HospitalityProvidersLogin');
        }
    }
}
