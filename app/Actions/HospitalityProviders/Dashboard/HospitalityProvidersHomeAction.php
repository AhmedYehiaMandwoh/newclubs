<?php

namespace App\Actions\HospitalityProviders\Dashboard;

use App\Classes\BaseAction;
use Inertia\Inertia;

class HospitalityProvidersHomeAction extends BaseAction
{

    public function handle(): \Inertia\Response
    {
        return Inertia::render('HospitalityProviders/Dashboard/Home');
    }
}
