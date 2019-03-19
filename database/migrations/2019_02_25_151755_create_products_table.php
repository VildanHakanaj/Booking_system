<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('brand');
            $table->longText('desc');
            $table->text('serial_number');
            //Check by using the status and the relation
            //Status is strictly for active or inactive for maintenance
            //I can check if a product is booked or not by using a left join of the relation
            $table->tinyInteger('status')->default(1);
            $table->longText('notes')->nullable();
            $table->date('maintenance')->nullable();
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
        Schema::dropIfExists('products');
    }
}
