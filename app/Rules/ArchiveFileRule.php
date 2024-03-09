<?php

namespace App\Rules;

use App\Models\Archive;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ArchiveFileRule implements Rule
{
    private $error_message='';
    public function passes($attribute, $value)
    {
        $validator = Validator::make([$attribute => $value], [
//            $attribute => 'mimes:'.implode(',',Archive::getArchiveMimeType()).'|max:500000',
            $attribute => 'max:500000',
        ]);
        if($validator->fails()){
            $this->error_message=($validator->messages()->toArray()[$attribute]);
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
