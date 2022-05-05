<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pesanan');
            $table->string('harga_pesanan', 20);
            $table->string('bukti_pembayaran', 100);
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
        Schema::dropIfExists('pembayarans');
    }
}
