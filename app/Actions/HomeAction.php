<?php

namespace App\Actions;

use App\Classes\BaseAction;
use Inertia\Inertia;

class HomeAction extends BaseAction
{
    public function handle(): \Inertia\Response
    {
        return Inertia::render('Home');
    }
}
