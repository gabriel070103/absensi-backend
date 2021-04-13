<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('hari', ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']);
            $table->timestamp('waktu');
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete();
            $table->integer('id_guru_mapel')->unsigned();
            $table->foreign('id_guru_mapel')->references('id')->on('guru_mapel')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
