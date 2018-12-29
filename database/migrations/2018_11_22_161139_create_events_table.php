<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description',1500);
            $table->string('image_path');
            $table->dateTime('event_date'); //data e hora em que vai comecar o evento
            $table->dateTime('opening_subscription_date');    //date e hora em que podemos comecar a nos inscrever no evento
            $table->dateTime('closing_subscription_date');  //data e hora em que acaba as inscrições para o evento
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
