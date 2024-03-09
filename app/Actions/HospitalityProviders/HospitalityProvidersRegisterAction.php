<?php

namespace App\Actions\HospitalityProviders;

use App\Classes\BaseAction;
use App\Enums\HospitalityProviderTypesEnum;
use Inertia\Response;

class HospitalityProvidersRegisterAction extends BaseAction
{


    public function handle(): Response|\Inertia\ResponseFactory
    {
        $this->pageTitle(__('base.HospitalityProvidersRegister'));
        $types = HospitalityProviderTypesEnum::getOptionsData();
        return inertia('HospitalityProviders/Register', compact('types'));
    }


}
