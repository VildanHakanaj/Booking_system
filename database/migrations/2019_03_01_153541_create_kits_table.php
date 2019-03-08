<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->increments('id');
            //name of the product
            $table->text('title');
            //The amount of days a kit can be book
            $table->integer('booking_window')->default(7);
            //Is this kit allowed to be booked back to back
            $table->tinyInteger('back_to_back')->default(0);
            //Can a kit be bookable
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('kits');
    }
}
