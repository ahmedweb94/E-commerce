<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manufact_name_ar');
            $table->string('manufact_name_en');
            $table->string('facebook')->nullable();
            $table->string('address')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('manufacts');
    }
}
