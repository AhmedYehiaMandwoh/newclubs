<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\BaseAction;
use App\Http\Requests\BranchRequest;
use App\Models\{Branch};
use Illuminate\Support\Facades\DB;

class BranchUpdateAction extends BaseAction
{
    public function handle(Branch $branch, BranchRequest $request)
    {
        $validated_data = $request->validated();
        DB::beginTransaction();
        $branch->update($validated_data);
        DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }
}
