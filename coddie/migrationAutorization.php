<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorizacaos', function (Blueprint $table) {
          $table->increments('id')->nullable(false);
          //$table->integer('user_id')->unsigned();
          //$table->foreign('user_id')->references('id')->onDelete('cascade');
          $table->string('namemotorista', 150)->nullable(false);
          $table->string('model', 50)->nullable(false);
          $table->string('placa', 20)->nullable(false);
          $table->string('aprovacao', 15)->nullable(false);
          $table->date('datasaida')->nullable(false);
          $table->time('horasaida')->nullable(false);
          $table->date('dataretorno')->nullable(false);
          $table->time('horaretorno')->nullable(false);
          $table->integer('kminicial')->nullable(false);
          $table->integer('kmfinal')->nullable(false);
          $table->string('observ', 100)->nullable(false);
          $table->string('autorizacao', 50)->nullable(false);
          $table->date('data')->nullable(false);
          $table->string('cientemot', 50)->nullable(false);
          $table->date('datacient')->nullable(false);
          $table->string('statusveiculo', 50)->nullable(false);
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
        Schema::dropIfExists('authorizacaos');
    }
}
