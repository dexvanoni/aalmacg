<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdmsAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_completo');
            $table->string('nome_guerra');
            $table->string('status');
            $table->string('posto_grad');
            $table->string('funcao');
            $table->string('saram');
            $table->string('local_trab');
            $table->string('contato');
            $table->string('email');
            $table->integer('pin');
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
        Schema::table('adms', function (Blueprint $table) {
            //
        });
    }
}
