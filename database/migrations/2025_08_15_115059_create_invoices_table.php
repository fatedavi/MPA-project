<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Primary key ID
            $table->string('no_invoice', 20)->unique(); // Nomor invoice auto-generate
            $table->date('tgl_invoice');
            $table->json('detail_invoice'); // Mengubah ke tipe JSON
            $table->string('nama_client', 50);
            $table->string('alamat_client', 400);
            $table->unsignedBigInteger('kd_admin');
            $table->string('up', 25);
            $table->string('nbast', 30)->nullable();
            $table->string('nbast2', 30)->nullable();
            $table->string('nbast3', 30)->nullable();
            $table->string('nbast4', 30)->nullable();
            $table->string('nbast5', 30)->nullable();
            $table->string('jenis_no', 20)->nullable();
            $table->string('no_fpb', 30)->nullable();
            $table->string('no_fpb2', 30)->nullable();
            $table->string('no_fpb3', 30)->nullable();
            $table->string('no_fpb4', 30)->nullable();
            $table->string('no_fpb5', 30)->nullable();
            $table->date('due_date');
            $table->string('nama_bank', 70);
            $table->string('an', 70);
            $table->string('ac', 25);
            $table->string('no_fp', 30)->nullable();
            $table->double('total_invoice', 15, 2);
            $table->string('status', 15);
            $table->date('tgl_paid')->nullable();
            $table->string('ttd', 225)->nullable();
            $table->string('ttdkwitansi', 225)->nullable();
            $table->string('ttdbast', 225)->nullable(); 
            $table->string('ttdbakn', 225)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};