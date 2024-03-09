<?php

namespace App\Actions\Withdraws;

use App\Classes\{Abilities, BaseAction};
use App\Models\Withdraw;

class WithdrawsDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_WITHDRAWS_DELETE;

    public function handle(Withdraw $withdraw): \Illuminate\Http\RedirectResponse
    {
        if ($withdraw) {

            $this->tryDelete($withdraw);
            return back();
        }
    }
}
