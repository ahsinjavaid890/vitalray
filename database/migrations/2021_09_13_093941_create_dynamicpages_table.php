<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamicpages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longtext('content');
            $table->string('show_on_footer');
            $table->string('show_bellow');
            $table->string('visible_order');
            $table->string('metta_tittle');
            $table->string('metta_description');
            $table->string('metta_keywords');
            $table->string('visible_status');
            $table->string('delete_status');
            $table->string('added_by');
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
        Schema::dropIfExists('dynamicpages');
    }
}
