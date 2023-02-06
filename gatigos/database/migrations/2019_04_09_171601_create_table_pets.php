<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('pet_id')->unsigned();
            $table->bigInteger('owner')->unsigned();
            $table->string('name');
            $table->string('chip_id')->nullable();
            $table->string('specie');
            $table->string('breed');
            $table->DateTime('bird_date');
            $table->double('weight');
            $table->timestamps();

            $table->foreign('owner')
            ->references('client_id')
            ->on('clients')
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
        Schema::dropIfExists('pets');
    }
}
