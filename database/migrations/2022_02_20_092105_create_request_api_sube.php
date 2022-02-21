<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestApiSube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sube_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("headers")->nullable(true);
            $table->string("body")->nullable(true);
            $table->string("action")->nullable(true);
            $table->string("endpoint")->nullable(true);
            $table->string("method")->nullable(true);
            $table->string("response")->nullable(true);
            $table->integer("status")->nullable(true)->default(0);
            $table->string("ip")->nullable(true);
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
        Schema::dropIfExists('sube_requests');
    }
}
