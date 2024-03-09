<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class QteRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^\d{1,6}([.]\d{1,3})?$/",$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('validation.qte');
    }
}
