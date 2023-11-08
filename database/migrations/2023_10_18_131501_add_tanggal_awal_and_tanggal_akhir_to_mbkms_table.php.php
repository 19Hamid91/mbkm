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
        Schema::table('mbkms', function (Blueprint $table) {
            $table->date('tanggal_awal')->nullable()->after('durasi');
            $table->date('tanggal_akhir')->nullable()->after('tanggal_awal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mbkms', function (Blueprint $table) {
            $table->dropColumn('tanggal_awal');
            $table->dropColumn('tanggal_akhir');
        });
    }
};
