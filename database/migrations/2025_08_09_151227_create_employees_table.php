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
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('nik', 20)->unique(); // Tambah kolom NIK
    $table->string('position');
    $table->decimal('base_salary', 12, 2)->default(0);
    $table->string('profile_photo')->nullable(); // Tambah kolom foto profil
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
