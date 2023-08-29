<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvitesAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evento_id')->unsigned();
            $table->integer('num_mesa')->nullabel();
            $table->integer('num_cadeira')->nullabel();
            $table->integer('saram');
            $table->float('valor');
            $table->string('pg')->nullabel();
            $table->timestamps();

            $table->foreign('evento_id')
                    ->references('id')
                    ->on('eventos')
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
        Schema::table('convites', function (Blueprint $table) {
            //
        });
    }
}
