<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspecaoDefeitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecao_defeito', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nivel');
            $table->integer('inspecao_id')->unsigned()->index();
            $table->foreign('inspecao_id')->references('id')->on('inspecaos');
            $table->integer('defeito_id')->unsigned()->index();
            $table->foreign('defeito_id')->references('id')->on('defeito_graves');
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
        Schema::dropIfExists('inspecao_defeito');
    }
}