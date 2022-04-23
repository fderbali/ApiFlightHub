<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legs', function (Blueprint $table) {
            $table->id();
            $table->string('airline', 2);
            $table->integer('number');
            $table->string('departure_airport', 3);
            $table->time('departure_time');
            $table->string('arrival_airport', 3);
            $table->time('arrival_time');
            $table->float('price');
            $table->unique(['airline','number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legs');
    }
}
