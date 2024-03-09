<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DateFormatCreatedAtRule implements Rule
{
    private $error_message = [];

    public function passes($attribute, $value)
    {
        $validator = Validator::make([$attribute => $value], [
            $attribute => "date_format:Y-m-d,Y-m-j"
        ]);

        if ($validator->fails()) {
            $this->error_message = ($validator->messages()->toArray()[$attribute]);
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
