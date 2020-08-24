<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    public $timestamps = false;
    public $fillable = [
        'dni',
        'abono',
        'apellido',
        'nombre',
    ];
}
