<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\datos_users;

class validacionTelefono implements Rule
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
        $data=datos_users::where($attribute,$value)->get();
        return $data->isEmpty();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lo sentimos,Este Telefono ya esta siendo utilizado';
    }
}
