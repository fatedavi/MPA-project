<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id_vendor');
            $table->string('nama_vendor', 100);
            $table->string('alamat_vendor', 500);
            $table->string('kota', 30);
            $table->string('up_vendor', 30);
            $table->string('no_telp', 20);
            $table->string('email_vendor', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}