<?php

namespace App\Actions\Sponsors;

use App\Classes\{Abilities, BaseAction};
use App\Models\Sponsor;

class SponsorsDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SPONSORS_DELETE;

    public function handle(Sponsor $sponsor): \Illuminate\Http\RedirectResponse
    {
        if ($sponsor) {

            $this->tryDelete($sponsor);
            return back();
        }
    }
}
