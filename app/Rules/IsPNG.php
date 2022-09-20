<?php

namespace App\Rules;

use GdImage;
use Illuminate\Contracts\Validation\Rule;

class IsPNG implements Rule
{

    protected $responseContentType;

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
        // $ch = curl_init($value);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, true);
        // curl_setopt($ch, CURLOPT_NOBODY, true);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

        // curl_exec($ch);
        // $this->responseContentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        $path = pathinfo($value);
                
        if (strtolower($path['extension']) == 'png') {
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
        return ':attribute deve ser do tipo PNG (image/png).';
    }
}
