<?php

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class AspekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = Bagian::all();

        $bagian->each(function() {
            factory(App\Models\Aspek::class, 15)->create();
        });
    }
}
