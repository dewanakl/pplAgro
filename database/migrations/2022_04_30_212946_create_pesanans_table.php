<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pesanan');
            $table->bigInteger('jumlah_pesanan');
            $table->string('harga_pesanan');
            $table->string('keterangan', 100);
            $table->dateTime('dibuat')->nullable();
            $table->dateTime('dibayar')->nullable();
            $table->dateTime('diproses')->nullable();
            $table->dateTime('dikirim')->nullable();
            $table->dateTime('selesai')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
