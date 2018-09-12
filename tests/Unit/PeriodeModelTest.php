<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PeriodeModelTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_bulan()
    {
        $periode = factory('App\Models\Periode')->create();

        $this->assertInstanceOf('App\Models\Bulan', $periode->bulan);
    }

    /** @test */
    public function it_has_bagian()
    {
        $bagian = factory('App\Models\Bagian')->create();
        $pegawai = factory('App\Models\Pegawai')->create(['bagian_id' => $bagian->id]);

        $this->assertInstanceOf('App\Models\Bagian', $pegawai->bagian);
    }
}
