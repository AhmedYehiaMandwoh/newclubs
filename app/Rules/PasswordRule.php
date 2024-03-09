<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class PasswordRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("^.{8,}^", $value);
        return preg_match("^[A-Za-z\d][@$!%*?&]?[A-Za-z\d]{8,}^", $value);
        return true;
        return preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$^", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('validation.password');
    }
}
