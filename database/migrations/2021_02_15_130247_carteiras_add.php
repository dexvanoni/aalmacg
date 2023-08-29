<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarteirasAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteiras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_completo');
            $table->string('nome_guerra');
            $table->string('status');
            $table->string('posto_grad');
            $table->string('soc_dep');
            $table->string('saram');
            $table->string('identidade');
            $table->string('validade');
            $table->string('email');
            $table->string('foto');
            $table->string('permissao');
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
        Schema::table('carteiras', function (Blueprint $table) {
            //
        });
    }
}
