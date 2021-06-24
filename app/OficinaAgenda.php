<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficinaAgenda extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'activa',
        'oficina_id',

    ];
    public function dias(){
        return $this->hasMany(OficinaAgendaDetalle::class);
    }
}
