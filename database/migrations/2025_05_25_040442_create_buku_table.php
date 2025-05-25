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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 20)->unique();
            $table->string('judul', 255);
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->string('bahasa', 50)->nullable();
            $table->string('penulis', 255);
            $table->string('penerbit', 255);
            $table->string('sampul', 255)->nullable();
            $table->integer('jumlah');
            $table->integer('jumlah_tersedia')->default(0);
            $table->integer('jumlah_dipinjam')->default(0);
            $table->enum('status', ['Tersedia', 'Habis'])->default('Tersedia');
            $table->string('deskripsi', 600);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
