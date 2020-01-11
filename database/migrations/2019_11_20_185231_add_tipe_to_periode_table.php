<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipeToPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->string('tipe', 25)->default('bulanan')->after('tahun');
            
            $table->dropUnique('periode_pegawai_id_bulan_id_tahun_unique');
            $table->unique(['pegawai_id', 'bulan_id', 'tahun', 'tipe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
}
