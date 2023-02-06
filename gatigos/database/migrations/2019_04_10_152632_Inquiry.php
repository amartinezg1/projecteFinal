<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inquiry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inquiry', function (Blueprint $table) {
          $table->bigIncrements('inquiry_id')->unique();
          $table->bigInteger('pet_id')->unsigned();
          $table->bigInteger('vet_id')->unsigned();
          $table->bigInteger('tracing_id')->unsigned()->nullable();
          $table->string('title');
          $table->dateTime('inquiry_date');
          $table->string('diagnostic');
          $table->string('observations')->nullable();
          $table->string('treatment')->nullable();
          $table->timestamps();

          $table->foreign('pet_id')
          ->references('pet_id')
          ->on('pets')
          ->onDelete('cascade');
			$table->foreign('vet_id')
			->references('user_id')
			->on('users')
          ->onDelete('cascade');
          $table->foreign('tracing_id')
          ->references('tracing_id')
          ->on('pathologies_tracing')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::dropIfExists('inquiry');
    }
}
