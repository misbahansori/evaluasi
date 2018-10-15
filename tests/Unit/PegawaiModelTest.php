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

    /** @test */
    public function ngetes_scope_milik_user()
    {
        $unit = factory('App\Models\Unit', 2)->create();
        $user = factory('App\Models\User')->create();
        $user->assignRole(2);
        $this->actingAs($user);

        $pegawai1 = factory('App\Models\Pegawai', 1)->create(['unit_id' => 1]);
        $pegawai2 = factory('App\Models\Pegawai', 2)->create(['unit_id' => 2]);

        $listPegawai = \App\Models\Pegawai::milikUser()->get();

        $this->assertEquals(2, $listPegawai->count());
    }
}
