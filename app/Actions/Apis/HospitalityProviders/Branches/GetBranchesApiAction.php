<?php

namespace App\Actions\Apis\HospitalityProviders\Branches;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Resources\BranchResource;
use App\Models\Branch;

class GetBranchesApiAction extends BaseAction
{
    public function handle()
    {
        return $this->apiSuccess(['branches'=> BranchResource::collection(
            Branch::where("hospitality_provider_id", Helpmate::getApiAuthTypeHospitality()->id)->get()
        )]);

    }
}
