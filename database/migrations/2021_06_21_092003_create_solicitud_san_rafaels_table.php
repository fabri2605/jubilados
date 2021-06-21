<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudSanRafaelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_san_rafaels', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_abono')->nullable(true);
            $table->string('apellido')->nullable(true);
            $table->string('nombre')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('fijo')->nullable(true);
            $table->string('celular')->nullable(true);
            $table->string('nro_tramite')->nullable(true);
            $table->string('nro_solicitud')->nullable(true);
            $table->string('sexo')->nullable(true);
            $table->date('fecha_nacimiento')->nullable(true);
            $table->string('cuit')->nullable(true);
            $table->string('calle')->nullable(true);
            $table->string('nro_calle')->nullable(true);
            $table->string('depto')->nullable(true);
            $table->string('piso')->nullable(true);
            $table->string('manzana')->nullable(true);
            $table->string('casa')->nullable(true);
            $table->string('localidad')->nullable(true);
            $table->longText('observaciones')->nullable(true);
            $table->string('estado')->nullable(true);
            $table->integer('codigo_postal')->nullable(true);
            $table->datetime('fecha_solicitud')->nullable(true);
            $table->string('dni')->nullable(true);
            $table->string('abono')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_san_rafaels');
    }
}
