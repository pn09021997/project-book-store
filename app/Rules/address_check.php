<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Adress;

class address_check implements Rule
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
        $dulieu = explode(',',$value);
//        $tinh_tp = $dulieu[0];
        $check_tinh = Adress::where('city_province','=',$dulieu[0])->where('district','=',$dulieu[1])->first();
        if ($check_tinh){
            return  true;
        }
        return  false;



    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The address error ';
    }
}
