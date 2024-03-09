<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use Inertia\Response;

class HospitalityProvidersForgetPasswordAction extends BaseAction
{

    public function handle(): Response|\Inertia\ResponseFactory
    {
        $this->pageTitle(__('base.forgetPassword'));
        return inertia('HospitalityProviders/ForgetPassword');
    }
}
