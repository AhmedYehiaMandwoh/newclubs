<?php

namespace App\Actions\Apis\HospitalityProviders;

use App\Classes\BaseAction;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class HospitalityProvidersIndexAction extends BaseAction
{
//    protected Abilities $ability=Abilities::;
    use ApiResponseTrait;

    public function handle(Request $request)
    {
        return 'nta logged in ya handasa';

    }
}
