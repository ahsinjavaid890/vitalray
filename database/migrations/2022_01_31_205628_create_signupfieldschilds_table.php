<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignupfieldschildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signupfieldschilds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('signup_parent');
            $table->foreign('signup_parent')->references('id')->on('signupfields');
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
        Schema::dropIfExists('signupfieldschilds');
    }
}
