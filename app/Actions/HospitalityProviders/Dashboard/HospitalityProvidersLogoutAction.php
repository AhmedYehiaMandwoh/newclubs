<?php

namespace App\Actions\HospitalityProviders\Dashboard;

use App\Classes\BaseAction;
use Illuminate\Support\Facades\Auth;

class HospitalityProvidersLogoutAction extends BaseAction
{
    public function handle()
    {
        Auth::guard('hospitality_provider')->logout();
        return redirect()->to('/hospitality_providers/login');
    }
}
