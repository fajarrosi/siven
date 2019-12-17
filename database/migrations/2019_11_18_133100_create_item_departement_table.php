<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_departement', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->integer('departement_id')->unsigned();

            $table->foreign('item_id')->references('id')->on('items')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('departement_id')->references('id')->on('departements')
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
        Schema::dropIfExists('item_departement');
    }
}
