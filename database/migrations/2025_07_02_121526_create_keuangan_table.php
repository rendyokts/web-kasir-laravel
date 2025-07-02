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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id()->comment('primary key');
            $table->date('tanggal')->comment('Tanggal Transaksi');
            $table->enum('jenis',['masuk','keluar'])->comment('jenis transaksi');
            $table->string('kategori', 100)->nullable()->comment('kategori seperti gaji, belanja,dll');
            $table->text('keterangan')->comment('deskripsi transaksi');
            $table->decimal('jumlah', 12,2)->comment('jumlah uang');
            $table->string('created_by', 50)->nullable()->comment('user yang input');
            $table->integer('status')->nullable();
            $table->string('file_lampiran', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
