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
        Schema::create('faskes_has_tenaga_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faskes_id');
            $table->foreignId('tenaga_kesehatan_id'); //foreign dengan user id
            $table->string('spesialisasi'); 
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
        Schema::dropIfExists('faskes_has_tenaga_kesehatans');
    }
};
