<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorrequests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('buisnessname');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('completeaddress');
            $table->string('website');
            $table->string('cnicfront');
            $table->string('cnicback');
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
        Schema::dropIfExists('vendorrequests');
    }
}
