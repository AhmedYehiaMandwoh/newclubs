<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use Inertia\Response;

class HospitalityProvidersLoginAction extends BaseAction
{

    public function handle(): Response|\Inertia\ResponseFactory
    {

        $this->pageTitle(__('base.HospitalityProvidersLogin'));
        return inertia('HospitalityProviders/Login');
    }
}
