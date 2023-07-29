<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminchildmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminchildmodules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('counter');
            $table->unsignedBigInteger('adminparent');
            $table->foreign('adminparent')->references('id')->on('adminmodules');
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
        Schema::dropIfExists('adminchildmodules');
    }
}
