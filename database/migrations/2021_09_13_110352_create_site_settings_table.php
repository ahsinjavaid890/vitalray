<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_moto');
            $table->string('site_icon');
            $table->string('site_basecolor');
            $table->string('site_basehovercolor');
            $table->string('metta_tittle');
            $table->string('metta_description');
            $table->string('metta_keywords');
            $table->string('metta_image');
            $table->string('cookies_content');
            $table->string('show_cookies_aggrement');
            $table->string('header_script');
            $table->string('body_script');
            $table->string('footer_script');
            $table->string('left_add_1');
            $table->string('left_add_2');
            $table->string('right_add_1');
            $table->string('right_add_2');
            $table->string('paypal');
            $table->string('stripe');
            $table->string('jazcash');
            $table->string('language_conversion');
            $table->string('currency_conversion');
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
        Schema::dropIfExists('site_settings');
    }
}
