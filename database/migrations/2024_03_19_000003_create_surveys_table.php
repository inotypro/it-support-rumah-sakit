<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->integer('pelayanan_medis_rating');
            $table->integer('fasilitas_rating');
            $table->integer('kebersihan_rating');
            $table->integer('kecepatan_pelayanan_rating');
            $table->integer('keramahan_staff_rating');
            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}; 