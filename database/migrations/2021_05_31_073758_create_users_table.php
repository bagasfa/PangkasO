<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
          $table->id();
          $table->string('name');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('gender')->nullable();
          $table->string('address')->nullable();
          $table->string('phone_number')->unique();
          $table->string('avatar')->nullable();
          $table->string('verify_status')->nullable();
          $table->bigInteger('id_role')->unsigned();
          $table->foreign('id_role')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
