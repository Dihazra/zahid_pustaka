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
        Schema::create('zahid_pinjam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('zahid_users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('zahid_books')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['pinjam', 'kembali','menunggu konfirmasi', 'ditolak'])->default('pinjam');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zahid_pinjam');
    }
};
