<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaEspecial extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $fillable = [
        'fecha',
        'descripcion',
        'se_repite',
    ];
}
