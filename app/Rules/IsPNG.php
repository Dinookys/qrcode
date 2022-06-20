<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsPNG implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return @exif_imagetype($value) === IMAGETYPE_PNG;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute deve ser do tipo PNG';
    }
}
