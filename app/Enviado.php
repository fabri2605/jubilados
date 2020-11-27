<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enviado extends Model
{
    public $timestamps = false;
    public $fillable = [
        'documento',
    ];
}
