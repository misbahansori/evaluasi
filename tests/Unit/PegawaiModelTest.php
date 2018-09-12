<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PegawaiModelTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_unit()
    {
        $unit = factory('App\Models\Unit')->create();

        $pegawai = factory('App\Models\Pegawai')->create(['unit_id' => $unit->id]);

        $this->assertInstanceOf('App\Models\Unit', $pegawai->unit);
    }

    /** @test */
    public function it_has_bagian()
    {
        $bagian = factory('App\Models\Bagian')->create();

        $pegawai = factory('App\Models\Pegawai')->create(['bagian_id' => $bagian->id]);

        $this->assertInstanceOf('App\Models\Bagian', $pegawai->bagian);
    }
}
