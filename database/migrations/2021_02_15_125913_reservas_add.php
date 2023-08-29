<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservasAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('socio');
            $table->string('tipo');
            $table->string('local');
            $table->string('dt_evento');
            $table->string('periodo');
            $table->string('alcool');
            $table->string('piscina');
            $table->string('campos_quadras_parques');
            $table->string('valor_pago');
            $table->string('status');
            $table->string('diretor');
            $table->string('pago');
            $table->string('obs')->nullable();
            $table->string('contato');
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
        Schema::table('reservas', function (Blueprint $table) {
            //
        });
    }
}
