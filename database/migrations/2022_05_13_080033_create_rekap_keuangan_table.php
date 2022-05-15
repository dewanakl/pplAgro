<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_keuangan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->dateTime('pendapatan')->nullable();
            $table->dateTime('pengeluaran')->nullable();
            $table->dateTime('pendapatan_bersih');

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
        Schema::dropIfExists('rekap_keuangan');
    }
}
