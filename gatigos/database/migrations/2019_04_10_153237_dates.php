<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('dates', function (Blueprint $table) {
          $table->bigIncrements('date_id')->unique();
          $table->string('date');
          $table->string('time');
          $table->double('day_date');
          $table->string('pet_name');
          $table->string('client_phone');

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
           Schema::dropIfExists('dates');
    }
}
