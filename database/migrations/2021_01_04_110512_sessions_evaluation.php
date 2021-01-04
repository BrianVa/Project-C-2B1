<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SessionsEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SessionsEvaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->index('user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->index('know_id');
            $table->integer('know_id')->unsigned();
            $table->foreign('know_id')->references('id')->on('Knowledgesessions');
            $table->text('data');
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
        Schema::drop('SessionsEvaluation');
    }
}
