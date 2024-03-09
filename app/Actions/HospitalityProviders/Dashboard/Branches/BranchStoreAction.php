<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Http\Requests\BranchRequest;
use App\Models\{Branch};

class BranchStoreAction extends BaseAction
{
    public function handle(BranchRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['hospitality_provider_id'] = Helpmate::getAuthHospitalityProvider()?->id;
        $branch = Branch::query()->create($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}


