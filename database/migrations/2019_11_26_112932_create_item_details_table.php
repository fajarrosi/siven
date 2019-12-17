<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_details', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('kode_item');
            $table->unsignedInteger('item_id')->unsigned();
            $table->unsignedInteger('user_id')->unsigned();
            $table->unsignedInteger('cond_id')->unsigned();
            $table->timestamps();

             $table->foreign('item_id')->references('id')->on('items')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('cond_id')->references('id')->on('conds')
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
        Schema::dropIfExists('item_details');
    }
}
