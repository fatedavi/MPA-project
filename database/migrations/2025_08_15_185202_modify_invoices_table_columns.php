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
        Schema::table('invoices', function (Blueprint $table) {
            // Modify no_invoice column from VARCHAR(20) to VARCHAR(255)
            $table->string('no_invoice', 255)->change();
            
            // Modify kd_admin column from BIGINT to VARCHAR(255)
            $table->string('kd_admin', 255)->change();

            $table->string('up', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Revert no_invoice column back to VARCHAR(20)
            $table->string('no_invoice', 20)->change();
            
            // Revert kd_admin column back to BIGINT
            $table->bigInteger('kd_admin')->unsigned()->change();

            $table->string('up', 255)->change();
        });
    }
};
