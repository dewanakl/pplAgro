<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pesanans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pesanan');
            $table->string('nama_agen', 50);
            $table->bigInteger('jumlah_pesanan');
            $table->bigInteger('harga_pesanan');
            $table->timestamps();

            $table->unsignedBigInteger('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pesanans');
    }
}
