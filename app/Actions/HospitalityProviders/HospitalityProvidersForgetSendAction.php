<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Http\Requests\ForgetRequest;
use App\Mail\ResetRestaurantsPassword;
use App\Models\{HospitalityProvider, PasswordReset};
use Illuminate\Support\Facades\Mail;

class HospitalityProvidersForgetSendAction extends BaseAction
{

    public function handle(ForgetRequest $request)
    {
        $HospitalityProviders = HospitalityProvider::where('email', $request->email)->first();
        if ($HospitalityProviders) {

            $reset = PasswordReset::create([
                'email' => $HospitalityProviders->email,
                'token' => bcrypt($HospitalityProviders->id . $HospitalityProviders->email),
            ]);

            Mail::to($HospitalityProviders)->send(new ResetRestaurantsPassword($reset));
            $this->makeSuccessSessionMessage(__('base.sent_successfully'));
            return redirect()->route('hospitality_providers.forgetPassword');
        } else {
            $this->makeErrorSessionMessage(__('base.no_email_founded'));
            return redirect()->route('hospitality_providers.forgetPassword');


        }

    }
}
