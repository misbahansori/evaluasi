<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCatatanFromPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('ditingkatkan');
        });
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('dipertahankan');
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
            $table->text('catatan')->nullable();
            $table->text('ditingkatkan')->nullable();
            $table->text('dipertahankan')->nullable();
        });
    }
}
