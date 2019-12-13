<?php

namespace Tests\Unit\Domain\Pegawai\Models;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use Tests\Setup\PegawaiFactory;
use App\Domain\Master\Models\Unit;
use Illuminate\Support\Collection;
use App\Domain\Master\Models\Bagian;
use App\Domain\Master\Models\Status;
use App\Domain\Master\Models\Formasi;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_unit()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceOf(Unit::class, $pegawai->unit);
    }

    /** @test */
    public function it_has_bagian()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceOf(Bagian::class, $pegawai->bagian);
    }

    /** @test */
    public function it_has_formasi()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceOf(Formasi::class, $pegawai->formasi);
    }
    
    /** @test */
    public function it_has_status()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceOf(Status::class, $pegawai->status);
    }

    /** @test */
    public function it_has_many_periode()
    {
        $pegawai = app(PegawaiFactory::class)->withPeriode()->create();
        
        $this->assertInstanceOf(Collection::class, $pegawai->periode);
        $this->assertInstanceOf(Periode::class, $pegawai->periode->first());
    }

    /** @test */
    public function periode_hanya_menampilkan_tipe_bulanan()
    {
        $pegawai = factory(Pegawai::class)->create();

        factory(Periode::class, 3)->create(['tipe' => 'bulanan', 'pegawai_id' => $pegawai->id]);
        factory(Periode::class, 1)->create(['tipe' => 'tahunan', 'pegawai_id' => $pegawai->id]);
        
        $this->assertCount(3, $pegawai->periode);
    }

    /** @test */
    public function periode_hanya_menampilkan_tipe_tahunan()
    {
        $pegawai = factory(Pegawai::class)->create();

        factory(Periode::class, 3)->create(['tipe' => 'bulanan', 'pegawai_id' => $pegawai->id]);
        factory(Periode::class, 1)->create(['tipe' => 'tahunan', 'pegawai_id' => $pegawai->id]);
        
        $this->assertCount(1, $pegawai->periodeTahunan);
    }

    /** @test */
    public function scope_milik_user()
    {
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();

        factory(Pegawai::class, 3)->create(['unit_id' => $user->roles[0]->id]);
        factory(Pegawai::class, 2)->create();

        $this->actingAs($user);
        
        $this->assertCount(3, Pegawai::milikUser()->get());
    }
}
