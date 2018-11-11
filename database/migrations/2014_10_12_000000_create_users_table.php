<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('username', 30)->unique();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('city', 50);
            $table->boolean('admin')->default(false);
            $table->json('hobby')->nullable();
            $table->string('api_token', 60)->default(str_random(60));
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
        Schema::dropIfExists('users');
    }
}
