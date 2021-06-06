<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHairstylePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hairstyle_picture', function (Blueprint $table) {
            $table->id();
            $table->string('picture');
            $table->bigInteger('hairstyle_id')->unsigned();
            $table->foreign('hairstyle_id')
                ->references('id')
                ->on('hairstyle')
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
        Schema::dropIfExists('hairstyle_picture');
    }
}
