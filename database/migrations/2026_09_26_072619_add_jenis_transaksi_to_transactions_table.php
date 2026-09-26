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
    Schema::table('transactions', function (Blueprint $table) {
        $table->enum('jenis_transaksi', ['main_ditempat', 'bawa_pulang'])->default('main_ditempat')->after('unit_id');
        $table->string('nama_tamu')->nullable()->after('customer_id'); // nama opsional saat main di tempat
        $table->foreignId('customer_id')->nullable()->change();       // pelanggan jadi opsional
    });
}

public function down(): void
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['jenis_transaksi', 'nama_tamu']);
        $table->foreignId('customer_id')->nullable(false)->change();
    });
}
};
