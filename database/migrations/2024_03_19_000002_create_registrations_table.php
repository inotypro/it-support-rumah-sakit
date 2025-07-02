<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')->nullable()->unique();
            $table->string('full_name');
            $table->string('nik', 16)->nullable()->unique();
            $table->string('gender');
            $table->date('birth_date');
            $table->string('phone_number');
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_parent_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('address')->nullable();
            $table->string('poly');
            $table->enum('status', ['proses', 'selesai', 'batal'])->default('proses');
            $table->enum('patient_type', ['baru', 'lama'])->default('baru');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}; 