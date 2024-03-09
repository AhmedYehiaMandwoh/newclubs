<?php

namespace App\Actions\Apis\HospitalityProviders\Branches;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Models\Branch;

class DeleteBranchApiAction extends BaseAction
{
    public function handle(Branch $branch)
    {
        abort_if($branch->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        if ($this->tryDelete($branch, false)) {
            return $this->apiSuccessMessage();
        }
        return $this->apiCantDelete();
    }
}
