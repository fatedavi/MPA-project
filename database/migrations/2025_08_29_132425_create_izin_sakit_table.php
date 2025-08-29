<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
            Schema::create('izin_sakit', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('employee_id');
                $table->text('alasan');
                $table->string('dokter_surat');
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('keterangan_admin')->nullable();
                
                // kolom baru untuk tracking admin
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->unsignedBigInteger('rejected_by')->nullable();

                $table->timestamps();

                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
                $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            });
    }

    public function down()
    {
        Schema::dropIfExists('izin_sakit');
    }
};
