<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'email',
        'telefono',
        'oficina_id',
        'fecha_turno',
        'hora_turno',
        'estado',
        'nro_turno',
    ];
    public function oficina(){
        return $this->belongsTo(Oficina::class, 'oficina_id');
    }
}
