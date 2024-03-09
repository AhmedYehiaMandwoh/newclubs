<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PriceRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $error_message = [];
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
         return preg_match("/^\d{1,15}([.]\d{1,3})?$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.money');
    }
}
