<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifDirekturToPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->timestamp('verif_direktur')->nullable()->after('verif_wadir');
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
            $table->removeColumn('verif_direktur');
        });
    }
}
