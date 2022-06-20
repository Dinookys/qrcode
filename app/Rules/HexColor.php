<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HexColor implements Rule
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
        
        $value = preg_replace('/[^a-z0-9]/', '', $value);
        return (bool) in_array(strlen($value), [3,4,6,8]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute deve ser representanda por um valor em hexadecimal com 3,4,6 ou 8 caracteres';
    }
}
