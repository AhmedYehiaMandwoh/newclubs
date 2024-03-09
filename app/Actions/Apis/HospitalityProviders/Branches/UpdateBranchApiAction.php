<?php

namespace App\Actions\Apis\HospitalityProviders\Branches;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Requests\Apis\ApiBranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;

class UpdateBranchApiAction extends BaseAction
{
    public function handle(Branch $branch, ApiBranchRequest $request)
    {
        abort_if($branch->hospitality_provider_id != Helpmate::getApiAuthTypeHospitality()->id, 404);
        $branch->update($request->validated());
        return $this->apiSuccess([
            'branch' => BranchResource::make($branch)
        ]);
    }
}
