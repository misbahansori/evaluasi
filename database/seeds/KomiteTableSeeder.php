<?php

use Illuminate\Database\Seeder;

class KomiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('komite')->insert([
            ['nama' => 'PMKP'],
            ['nama' => 'PPI'],
            ['nama' => 'Akreditasi'],
            ['nama' => 'Keperawatan'],
            ['nama' => 'Medis'],
        ]);
    }
}
