<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', '100');
            $table->boolean('active')->default('1');
            $table->string('firstname','255');
            $table->string('lastname', '255');
            $table->dateTime('dateofbirth');
            $table->string('dietary','255')->nullable();
            $table->string('avatar')->default('elmo.jpg');

            $table->index('role_id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('Roles')->onDelete('cascade');;

            $table->index('sex_id');
            $table->integer('sex_id')->unsigned();
            $table->foreign('sex_id')->references('id')->on('Sex')->onDelete('cascade');;

            $table->rememberToken();

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
        Schema::drop('Users');
    }
}
