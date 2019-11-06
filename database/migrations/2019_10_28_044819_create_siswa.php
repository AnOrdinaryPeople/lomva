<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->enum('kelas',['X-RPL','XI-RPL','XII-RPL','X-TKJ','XI-TKJ','XII-TKJ','X-AP','XI-AP','XII-AP']);
            $table->string('kontak',100);
            $table->dateTime('tgl_lahir');
            $table->string('asal_sekolah',100);
            $table->string('asal_daerah',100);
            $table->string('image',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
