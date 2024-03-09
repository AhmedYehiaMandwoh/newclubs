<?php

namespace App\Rules;

use App\Models\Archive;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class SaudiNationalIdRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^\d{10}$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('validation.national_id');
    }
}
