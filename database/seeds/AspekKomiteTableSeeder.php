<?php

use Illuminate\Database\Seeder;
use App\Domain\Master\Models\Komite;
use App\Domain\Master\Models\AspekKomite;

class AspekKomiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listKomite = Komite::all();

        $listKomite->each(function($komite) {
            factory(AspekKomite::class, rand(8,12))->create(['komite_id' => $komite->id]);
        });
    }
}
