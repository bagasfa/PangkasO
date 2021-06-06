<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHairstyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hairstyle', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('gender');
            $table->integer('price');
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('barbershop_id')->unsigned();
            $table->foreign('barbershop_id')
                ->references('id')
                ->on('barbershop')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('hairstyle');
    }
}
