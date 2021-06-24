<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOficinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('direccion')->nullable(false);
            $table->string('localidad')->nullable(false);
            $table->string('lat')->nullable(false);
            $table->string('lng')->nullable(false);
            $table->integer('visibilidad_web')->nullable(false)->default(0);
            $table->integer('aplica_restriccion')->nullable(false)->default(0);
            $table->string('denominacion')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oficinas');
    }
}
