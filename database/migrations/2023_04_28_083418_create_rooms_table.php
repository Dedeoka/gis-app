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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumahsakit_id')->constrained('rumahsakits')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->string('visiting_hours')->nullable();
            $table->string('capacity')->nullable();
            $table->string('type')->nullable();
            $table->string('thumbnail_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
