<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DateTimeFormatCreatedAtRule implements Rule
{
    private array $error_message = [];

    public function __construct(public bool $validate_second=true)
    {
    }

    public function passes($attribute, $value): bool
    {
        $validator = Validator::make([$attribute => $value], [
            $attribute => $this->validate_second?"date_format:Y-m-d H:i":"date_format:Y-m-d H:i:s"
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
