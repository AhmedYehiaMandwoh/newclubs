<?php

namespace App\Actions\HospitalityProviders\Dashboard\Branches;

use App\Classes\BaseAction;
use App\Models\Branch;

class BranchDeleteAction extends BaseAction
{
//    protected Abilities $ability=Abilities::;

    public function handle(Branch $branch): \Illuminate\Http\RedirectResponse
    {
        if ($branch) {

            $this->tryDelete($branch);
            return back();
        }
    }
}
