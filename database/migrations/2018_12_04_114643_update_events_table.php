<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('description');
            $table->string('image_path');
            $table->dateTime('event_date'); //data e hora em que vai comecar o evento
            $table->dateTime('opening_subscription_date');    //date e hora em que podemos comecar a nos inscrever no evento
            $table->dateTime('closing_subscription_date');  //data e hora em que acaba as inscrições para o evento
        });      
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
