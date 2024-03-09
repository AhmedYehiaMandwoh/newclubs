<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TimeformatRole implements Rule
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
        $validate = Validator::make([$attribute => $value], [
            $attribute => "date_format:H:i"
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
