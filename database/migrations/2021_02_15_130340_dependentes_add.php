<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DependentesAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('socio_id')->unsigned();
            $table->string('foto');
            $table->string('nome_completo');
            $table->string('dt_inscricao');
            $table->string('sexo')->nullable();
            $table->string('dt_nasc')->nullable();
            $table->string('email')->nullable();
            $table->string('celular');
            $table->string('rua')->nullable();
            $table->string('cep')->nullable();
            $table->string('num_casa')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->integer('pin');
            $table->string('carteira')->nullable();
            $table->timestamps();

            $table->foreign('socio_id')
                    ->references('id')
                    ->on('socios')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dependentes', function (Blueprint $table) {
            //
        });
    }
}
