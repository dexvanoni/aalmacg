<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificacaosAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('socio_id')->unsigned();
            $table->longText('notificacao');
            $table->string('nivel');
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
        Schema::table('notificacaos', function (Blueprint $table) {
            //
        });
    }
}
