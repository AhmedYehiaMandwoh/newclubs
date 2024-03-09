<?php

namespace App\Actions\Vistor;

use App\Classes\BaseAction;
use App\Models\Branch;

class OpenQrForBranchAction extends BaseAction
{
    public function handle(Branch $branch)
    {
        return "welcome in branch ".$branch->name;
    }
}
