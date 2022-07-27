<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class phoneVietNamCheck implements Rule
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
        if (strlen($value)!= 10){
            return false;
        }
        else{
            if ($value[0] != '0'){
                return  false;
            }
            for ($i = 1;$i<strlen($value);$i++){
                if (ord($value[$i])<48 || ord($value[$i]>57)){
                    return false;
                }
            }
        }
        return  true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The number phone is invalid';
    }
}
