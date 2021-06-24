<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficinaAgendaDetalle extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'llegada',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'cantidad_turnos',
        'tiempo_minutos',
        'oficina_agenda_id',
        'hora_inicio_tarde',
        'hora_fin_tarde',
        'cantidad_turnos_tarde',
        'tiempo_minutos_tarde',
    ];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
}
