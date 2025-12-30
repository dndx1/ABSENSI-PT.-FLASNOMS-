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
        Schema::create('replication_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id')->nullable(); // ID absensi yang direplikasi
            $table->enum('consistency_mode', ['STRONG', 'EVENTUAL', 'WEAK'])->default('EVENTUAL');
            $table->string('target_server', 100)->default('Server B'); // Server tujuan
            $table->timestamp('send_time')->useCurrent(); // Waktu kirim dari Server A
            $table->timestamp('receive_time')->nullable(); // Waktu terima di Server B
            $table->integer('latency_ms')->nullable(); // Latency dalam milliseconds
            $table->enum('status', ['SUCCESS', 'DELAY', 'PENDING', 'FAILED'])->default('PENDING');
            $table->text('error_message')->nullable(); // Pesan error jika gagal
            $table->timestamps();

            // Index untuk performa
            $table->index('attendance_id');
            $table->index('status');
            $table->index('consistency_mode');
            $table->index('send_time');

            // Foreign key ke tabel attendances (opsional, jika tabel attendance sudah ada)
            // $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replication_logs');
    }
};