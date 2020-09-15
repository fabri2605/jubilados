<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'tipo_abono',
        'apellido',
        'nombre',
        'cuit',
        'fecha_nacimiento',
        'email',
        'fijo',
        'celular',
        'nro_tramite',
        'nro_solicitud',
        'sexo',
        'calle',
        'nro_calle',
        'piso',
        'depto',
        'manzana',
        'calle',
        'localidad',
        'departamento',
        'observaciones',
        'estado',
        'codigo_postal',
        'fecha_solicitud',
        'dni'
    ];
}
