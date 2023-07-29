<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_type');
            $table->string('api_token')->unique();
            $table->string('phonenumber')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('cnic_front')->nullable();
            $table->string('cnic_back')->nullable();
            $table->string('website')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->unsignedBigInteger('active');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('is_admin');
            $table->foreign('role_id')->references('id')->on('roles');
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
