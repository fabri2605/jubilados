<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = [
        'denominacion',
        'direccion',
        'localidad',
        'lat',
        'lng',
        'visibilidad_web',
        'aplica_restriccion',
    ];
    public function agendas(){
        return $this->hasMany(OficinaAgenda::class, 'oficina_id')->with('dias');
    }
}
