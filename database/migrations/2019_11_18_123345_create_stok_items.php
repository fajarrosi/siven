<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('items_id');
            $table->unsignedInteger('departements_id');
            $table->unsignedInteger('conds_id');
            $table->string('total');
            $table->timestamps();


            $table->foreign('items_id')->references('id')->on('items')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('departements_id')->references('id')->on('departements')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('conds_id')->references('id')->on('conds')
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
        Schema::dropIfExists('stok_items');
    }
}
