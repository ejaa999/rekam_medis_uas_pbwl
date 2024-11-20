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
        Schema::create('ktp_pasiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->default('2000-01-01');
            $table->integer('jenis_kelamin')->default(1); //1 = laki laki, 2 = perempuan
            $table->integer('agama')->default(1);
            $table->integer('status_perkawinan')->default(1);
            $table->integer('golongan_darah')->default(0);
            $table->string('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->integer('kewarganegaraan')->default(1);
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
        Schema::dropIfExists('ktp_pasiens');
    }
};
