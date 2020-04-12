<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datos_users extends Model
{
    //

    protected $fillable = [
        'nombre','paterno','materno', 'telefono', 'direccion',
    ];

}
