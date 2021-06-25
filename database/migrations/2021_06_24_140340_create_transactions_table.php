<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('no_antri')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->bigInteger('hairstyle_id')->unsigned();
            $table->foreign('hairstyle_id')
                ->references('id')
                ->on('hairstyle')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->bigInteger('barbershop_id')->unsigned();
            $table->foreign('barbershop_id')
                ->references('id')
                ->on('barbershop')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('jenis_layanan');
            $table->string('harga');
            $table->string('konfirmasi');
            $table->string('jam_booking');
            $table->string('pesan')->nullable();
            $table->string('lokasi')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
