<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Unit;
use App\Models\User;
use App\Models\Bagian;
use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PegawaiModelTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_unit()
    {
        $unit = factory(Unit::class)->create();

        $pegawai = factory(Pegawai::class)->create(['unit_id' => $unit->id]);

        $this->assertInstanceOf(Unit::class, $pegawai->unit);
    }

    /** @test */
    public function it_has_bagian()
    {
        $bagian = factory(Bagian::class)->create();

        $pegawai = factory(Pegawai::class)->create(['bagian_id' => $bagian->id]);

        $this->assertInstanceOf(Bagian::class, $pegawai->bagian);
    }

    /** @test */
    public function ngetes_scope_milik_user()
    {
        $unit = factory(Unit::class, 2)->create();
        $user = factory(User::class)->create();
        $user->assignRole(2);
        $this->actingAs($user);

        $pegawai1 = factory(Pegawai::class, 1)->create(['unit_id' => 1]);
        $pegawai2 = factory(Pegawai::class, 2)->create(['unit_id' => 2]);

        $listPegawai = Pegawai::milikUser()->get();

        $this->assertEquals(2, $listPegawai->count());
    }
}
