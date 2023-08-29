<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PiscinasAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piscinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carteira_id');
            $table->string('tipo');
            $table->string('pin');
            $table->string('convidado');
            $table->string('obs');
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
        Schema::table('piscinas', function (Blueprint $table) {
            //
        });
    }
}
