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
            $table->string('name', 30);
            $table->string('nohp', 13)->unique();
            $table->string('email', 50)->unique();
            $table->string('alamat')->nullable();
            $table->string('foto_profil')->default('default.jpg');
            $table->string('password');
            $table->timestamps();

            $table->unsignedBigInteger('idRole');
            $table->foreign('idRole')->references('id')->on('role')->cascadeOnDelete();
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
