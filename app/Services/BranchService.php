<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Offer;

class BranchService
{
    public function getBranchCanWinOffersWithWin(Branch $branch): void
    {
        $offers=Offer::where('is_active', true)->where('branch_id', $branch->id)->get();
    }
}
