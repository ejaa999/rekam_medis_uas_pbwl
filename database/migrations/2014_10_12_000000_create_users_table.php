<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->text('foto_profil')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->string('no_hp')->default('08123456789');
            $table->integer('jenis_kelamin')->default(1); //1 = laki laki, 2 = perempuan
            $table->date('tanggal_lahir')->default('2000-01-01');
            $table->integer('tipe_tenaga_kesehatan')->default(0); // 0 = non Tenaga Kesehatan, 1 = dokter, 2 = pengobat tradisional
            $table->integer('visibility')->default(1); // 1 = true, 0 = false
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
        Schema::dropIfExists('users');
    }
};
