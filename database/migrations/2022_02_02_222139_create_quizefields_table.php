<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizefieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizefields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('quiz_parent');
            $table->foreign('quiz_parent')->references('id')->on('quizes');
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
        Schema::dropIfExists('quizefields');
    }
}
