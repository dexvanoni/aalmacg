<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCautelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cautelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carteira');
            $table->text('material');
            $table->string('status');
            $table->string('condicao');
            $table->text('obs');
            $table->string('diretor');
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
        Schema::dropIfExists('cautelas');
    }
}
