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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data pribadi
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('nik', 20)->unique();

            // Dokumen
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('cv')->nullable();

            // Data pekerjaan
            $table->decimal('base_salary', 12, 2)->default(0);
            $table->string('position');

            // Data kontak/login
            $table->string('email')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
