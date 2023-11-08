<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbkms', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->string('pers_kaprodi');
            $table->string('pers_kajur');
            $table->string('pers_direktur');
            $table->string('jenis_mbkm');
            $table->string('diterima');
            $table->string('form_mbkm');
            $table->string('sk_direktur');
            $table->string('evaluasi');
            $table->string('form_penilaian_pembimbing');
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
        Schema::dropIfExists('mbkms');
    }
};
