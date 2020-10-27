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
            $table->id();
            $table->string('email')->unique();
            $table->string('password', '100');
            $table->boolean('active')->default('1');
            $table->string('firstname','255');
            $table->string('lastname', '255');
            $table->dateTime('dateofbirth');
            $table->integer('role_id');
            $table->integer('sex_id');
            $table->string('dietary','255')->nullable();
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
