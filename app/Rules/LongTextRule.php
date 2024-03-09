<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LongTextRule implements Rule
{
    protected $error_message = [];

    public function passes($attribute, $value)
    {
        $validate = Validator::make([$attribute => $value], [
            $attribute => "min:2,max:1000"
        ]);

        if ($validate->fails()) {
            $this->error_message = ($validate->messages()->toArray()[$attribute]);
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_message;
    }
}
