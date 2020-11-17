<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SessionOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SessionOrder', function (Blueprint $table) {
            $table->increments('id');

            $table->index('user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->index('know_id');
            $table->integer('know_id')->unsigned();
            $table->foreign('know_id')->references('id')->on('Knowledgesessions');
            $table->dateTime('sign_up_at');
            $table->boolean('cancelled')->default('1');
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
        Schema::drop('SessionOrder');
    }
}
