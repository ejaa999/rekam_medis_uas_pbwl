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
        Schema::create('hubungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenaga_kesehatan_id'); // fk dengan user
            $table->foreignId('pasien_id'); // fk dengan user
            $table->integer('status_hubungan')->default(0); // 0 = pending, 1 = diterima, kalau ditolak delete langsung
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
        Schema::dropIfExists('hubungans');
    }
};
