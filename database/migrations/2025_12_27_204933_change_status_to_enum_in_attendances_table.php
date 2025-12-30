<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Hapus kolom status lama
            $table->dropColumn('status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            // Buat ulang dengan enum - TAMBAHKAN SEMUA STATUS
            $table->enum('status', [
                'tepat_waktu', 
                'terlambat', 
                'sangat_terlambat',  // ← TAMBAH INI
                'lembur',            // ← TAMBAH INI
                'izin',              // ← TAMBAH INI (untuk masa depan)
                'sakit',             // ← TAMBAH INI (untuk masa depan)
                'alpha'
            ])->default('tepat_waktu')->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->string('status')->default('tepat_waktu')->after('type');
        });
    }
};