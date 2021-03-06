<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KnowledgesessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Knowledgesessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', '255');
            $table->text('desc');
            $table->dateTime('begin_date');
            $table->dateTime('end_date');
            $table->integer('max_atendees');
            $table->integer('min_atendees');

            $table->index('user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->boolean('active')->default('1');
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
        Schema::drop('Knowledgesessions');
    }
}
