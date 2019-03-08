<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookableKit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create the user table
        Schema::create('bookable_kit', function (Blueprint $table) {

            //Id of the user
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('kit_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('kit_id')->references('id')->on('kits');
            $table->timestamp();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
