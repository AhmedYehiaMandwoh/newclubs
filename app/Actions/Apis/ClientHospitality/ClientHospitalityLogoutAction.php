<?php

namespace App\Actions\Apis\ClientHospitality;

use App\Classes\BaseAction;
use App\Classes\Helpmate;

class ClientHospitalityLogoutAction extends BaseAction
{
    public function handle()
    {
        Helpmate::getApiAuth()?->tokens()->delete();
        return $this->apiResponseMobile(__('base.logout'), null);
    }
}
