<?php

namespace App\Rules;

use GdImage;
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
        $img = @imagecreatefrompng($value);

        if($img !== false) {
            imagedestroy($img);
            return true;
        }
        return false;
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
