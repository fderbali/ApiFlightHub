<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->string('code', 3);
            $table->string('name', 100);
            $table->string('city_code', 3);
            $table->string('city', 100);
            $table->string('country_code', 2);
            $table->string('region_code', 2);
            $table->float('latitude');
            $table->float('longitude');
            $table->string('timezone', 100);
            $table->primary('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
