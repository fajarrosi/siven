<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersetujuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('pngjuan_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('stat_id')->references('id')->on('stats')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('pngjuan_id')->references('id')->on('pengajuans')
            ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persetujuans');
    }
}
