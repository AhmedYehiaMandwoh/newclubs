<?php

namespace App\Models\Builders;

use Carbon\Carbon;

class OfferBuilder extends BaseBuilder
{
    public function canWin(): OfferBuilder
    {
        return $this->where('valid_to_date','>=',Carbon::now())
            ->whereRaw('max_used > count_used');
    }

    public function branchId(int $id): OfferBuilder
    {
        return $this->where('branch_id',$id);
    }
}
