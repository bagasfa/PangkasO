<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbershopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbershop', function (Blueprint $table) {
            $table->id();
            $table->string('banner')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('service_preferences')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('url')->unique()->nullable();
            $table->mediumText('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('barbershop');
    }
}
