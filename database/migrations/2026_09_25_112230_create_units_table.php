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
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('jenis', ['PS3', 'PS4', 'PS5']);
        $table->unsignedInteger('harga_per_jam');
        $table->enum('status', ['tersedia', 'digunakan', 'rusak'])->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
