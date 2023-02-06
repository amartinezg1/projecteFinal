<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class pathologiesTracing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pathologies_tracing', function (Blueprint $table) {
          $table->bigIncrements('tracing_id')->unique();
          $table->bigInteger('pathologie_id')->unsigned();
          $table->bigInteger('pet_id')->unsigned();
          $table->string('active');
          $table->timestamps();

          $table->foreign('pathologie_id')
          ->references('pathologie_id')
          ->on('pathologies')
          ->onDelete('cascade');

          $table->foreign('pet_id')
          ->references('pet_id')
          ->on('pets')
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
            Schema::dropIfExists('pathologies_tracing');
    }
}
