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
            $table->float('nilai_dosbing')->nullable()->after('dosbingex_id');
            $table->float('nilai_pemlap')->nullable()->after('nilai_dosbing');
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
            $table->dropColumn('nilai_dosbing');
            $table->dropColumn('nilai_pemlap');
        });
    }
};
