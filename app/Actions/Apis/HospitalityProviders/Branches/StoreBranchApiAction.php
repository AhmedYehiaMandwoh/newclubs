<?php

namespace App\Actions\Apis\HospitalityProviders\Branches;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Requests\Apis\ApiBranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;

class StoreBranchApiAction extends BaseAction
{
    public function handle(ApiBranchRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data["hospitality_provider_id"] = Helpmate::getApiAuthTypeHospitality()->id;
        $branch = Branch::query()->create($validated_data);
        return $this->apiSuccess([
            'branch' => BranchResource::make($branch)
        ]);
    }
}
