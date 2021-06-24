<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOficinaAgendaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficina_agenda_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio')->nullable(true);
            $table->date('fecha_fin')->nullable(true);
            $table->integer('llegada')->nullable(true)->default(0);
            $table->integer('dia_semana')->default(1)->nullable(true);
            $table->time('hora_inicio')->nullable(true);
            $table->time('hora_fin')->nullable(true);
            $table->integer('cantidad_turnos')->default(0)->nullable(true);
            $table->integer('tiempo_minutos')->default(0)->nullable(true);
            $table->integer('oficina_agenda_id');
            $table->time('hora_inicio_tarde')->nullable(true);
            $table->time('hora_fin_tarde')->nullable(true);
            $table->integer('cantidad_turnos_tarde')->default(0)->nullable(true);
            $table->integer('tiempo_minutos_tarde')->default(0)->nullable(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oficina_agenda_detalles');
    }
}
