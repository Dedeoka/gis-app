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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumahsakit_id')->constrained('rumahsakits')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('operational')->nullable();
            $table->string('description')->nullable();
            $table->string('image_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
