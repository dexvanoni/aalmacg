<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LivrosAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('saram');
            $table->string('nome_completo');
            $table->string('nome_guerra');
            $table->string('dt_sv');
            $table->longText('eventos')->nullable();
            $table->longText('reservas')->nullable();
            $table->longText('piscina')->nullable();
            $table->longText('cateiras_criadas')->nullable();
            $table->longText('socios_inscritos')->nullable();
            $table->longText('deps_inscritos')->nullable();
            $table->longText('convidados')->nullable();
            $table->longText('ocorrencias')->nullable();
            $table->longText('campos_quadras_parques')->nullable();
            $table->longText('limpeza');
            $table->longText('estrutura');
            $table->longText('notificacaoes');
            $table->float('valor_caixa');
            $table->string('passo_ao');
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
        Schema::table('livros', function (Blueprint $table) {
            //
        });
    }
}
