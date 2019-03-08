<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create the user table
        Schema::create('users', function (Blueprint $table) {

            //Id of the user
            $table->increments('id');

            //Need information
            $table->string('name');
            $table->string('email')->unique();

            //Student number
            $table->integer('stdn')->unique();

            //I made the address and number nullable so the user can fill those in after they login
            $table->string('home_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password')->nullable();

            //Give admin privileges to the user if true
            $table->boolean('admin')->default(0);
            $table->string('token')->nullable();

            //Information on the account
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
