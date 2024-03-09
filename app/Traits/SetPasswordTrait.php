<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Trait SetPasswordTrait
{
    function setPasswordAttribute($value): void
    {
        if ($value==null || $value==''){
            $this->attributes['password']=$this->password;
        }else{
            $this->attributes['password'] = strlen($value) < 50 ? bcrypt($value) : $value;
        }
    }
}
