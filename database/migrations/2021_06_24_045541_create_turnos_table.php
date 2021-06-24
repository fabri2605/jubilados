<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_turno')->nullable(true);
            $table->string('nombre')->nullable(true);
            $table->string('apellido')->nullable(true);
            $table->string('documento')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('telefono')->nullable(true);
            $table->integer('oficina_id');
            $table->date('fecha_turno');
            $table->time('hora_turno');
            $table->string('estado');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
}
