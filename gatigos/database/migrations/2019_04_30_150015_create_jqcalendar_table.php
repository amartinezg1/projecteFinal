<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJqcalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jqcalendar', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            #$table->bigInteger('owner')->unsigned();
            #$table->string('client_phone');
            #$table->string('pet_name');
            #$table->string('dni')->nullable();
            $table->string('Subject', 1000)->charset('utf8')->nullable($value = true)->default(null);
            $table->string('Location', 200)->charset('utf8')->nullable($value = true)->default(null);
            $table->string('Description', 255)->charset('utf8')->nullable($value = true)->default(null);
            $table->dateTime('StartTime')->nullable($value = true)->default(null);
          	$table->dateTime('EndTime')->nullable($value = true)->default(null);
          	$table->smallInteger('IsAllDayEvent')->nullable($value = true)->default(null);
          	$table->string('Color', 200)->charset('utf8')->nullable($value = true)->default(null);
          	$table->string('RecurringRule', 500)->charset('utf8')->nullable($value = true)->default(null);

            $table->charset = 'utf8';
           	$table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';
             
            #$table->foreign('owner')
            #->references('client_id')
            #->on('clients')
            #->onDelete('cascade');
            
             #$table->foreign('dni')
            #->references('dni')
            #->on('clients')
            #->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jqcalendar');
    }
}
