<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SociosAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('saram');
            $table->string('foto');
            $table->string('posto_grad');
            $table->string('nome_completo');
            $table->string('nome_guerra');
            $table->string('dt_inscricao');
            $table->string('sexo')->nullable();
            $table->string('dt_nasc')->nullable();
            $table->string('email')->nullable();
            $table->string('celular');
            $table->string('ramal')->nullable();
            $table->string('local_trab');
            $table->string('rua');
            $table->string('cep')->nullable();
            $table->string('num_casa');
            $table->string('bairro');
            $table->string('complemento')->nullable();
            $table->integer('num_deps')->nullable();
            $table->integer('pin');
            $table->string('status');
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
        Schema::table('socios', function (Blueprint $table) {
            //
        });
    }
}
