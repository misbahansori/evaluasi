<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pegawai_id');
            $table->unsignedInteger('bulan_id');
            $table->string('tahun', 4);
            $table->boolean('verif_kabag')->default(0);
            $table->boolean('verif_wadir')->default(0);
            $table->timestamps();

            $table->unique(['pegawai_id', 'bulan_id', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode');
    }
}
