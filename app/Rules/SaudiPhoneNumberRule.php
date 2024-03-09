<?php

namespace App\Rules;

use App\Models\Archive;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class SaudiPhoneNumberRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)(\d{7})$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('validation.phone');
    }
}
