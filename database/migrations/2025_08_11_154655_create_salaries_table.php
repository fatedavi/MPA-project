<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('month'); // Bulan gaji
            $table->unsignedSmallInteger('year'); // Tahun gaji
            $table->decimal('base_salary', 15, 2);
            $table->decimal('total_bonus', 15, 2)->default(0);         // dari tabel attendances
            $table->decimal('total_event_reward', 15, 2)->default(0);  // dari event_attendances + event.reward
            $table->unsignedSmallInteger('total_cut')->default(0);     // jumlah hari cuti
            $table->decimal('potongan_cuti', 15, 2)->default(0);       // potongan karena cuti
            $table->decimal('total_salary', 15, 2);                    // base + bonus + event - potongan
            $table->string('status')->default('pending');              // status gaji (optional)
            $table->timestamps();

            $table->unique(['employee_id', 'month', 'year'], 'salary_employee_month_year_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
