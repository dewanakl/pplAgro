<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pesanans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pesanan');
            $table->bigInteger('jumlah_pesanan');
            $table->string('harga_pesanan', 50);
            $table->string('status_pesanan', 100);
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
        Schema::dropIfExists('status_pesanans');
    }
}
