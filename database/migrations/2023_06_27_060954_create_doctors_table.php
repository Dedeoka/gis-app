<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumahsakit_id')->constrained('rumahsakits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('doctor_name')->nullable();
            $table->string('doctor_image')->nullable();
            $table->string('schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
