<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSubscriptionsElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_subscription_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('form_elements_id')->unsigned()->index();
            $table->foreign('form_elements_id')->references('id')->on('form_elements')->onDelete('cascade');
            $table->integer('subscription_user_id')->unsigned()->index();
            $table->foreign('subscription_user_id')->references('user_id')->on('subscriptions')->onDelete('cascade');
            $table->integer('subscription_event_id')->unsigned()->index();
            $table->foreign('subscription_event_id')->references('event_id')->on('subscriptions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_subscription_elements');
    }
}
