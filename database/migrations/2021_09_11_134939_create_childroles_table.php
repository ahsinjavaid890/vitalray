<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childroles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module');
            $table->unsignedBigInteger('role');
            $table->foreign('module')->references('id')->on('adminchildmodules');
            $table->foreign('role')->references('id')->on('roles');
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
        Schema::dropIfExists('childroles');
    }
}
