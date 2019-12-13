<?php

namespace Tests\Unit\Domain\Penilaian\Models;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use Tests\Setup\PegawaiFactory;
use Tests\Setup\PeriodeFactory;
use App\Domain\User\Models\User;
use Illuminate\Support\Collection;
use App\Domain\Master\Models\Bulan;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeriodeTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void
    {
        parent::setUp();
        
        \DB::table('permissions')->insert([
            ['name' => 'verif kabag', 'guard_name' => 'web'],
            ['name' => 'verif wadir', 'guard_name' => 'web'],
        ]);

       (new \BulanTableSeeder())->run();

    }
    /** @test */
    public function it_has_bulan()
    {
        $periode = factory(Periode::class)->create();

        $this->assertInstanceOf(Bulan::class, $periode->bulan);
    }

    /** @test */
    public function it_has_pegawai()
    {
        $periode = factory(Periode::class)->create();

        $this->assertInstanceOf(Pegawai::class, $periode->pegawai);
    }

    /** @test */
    public function it_has_many_nilai()
    {
        $periode = factory(Periode::class)->create();
        factory(Nilai::class)->create(['periode_id' => $periode->id]);
        
        $this->assertInstanceOf(Collection::class, $periode->nilai);
        $this->assertInstanceOf(Nilai::class, $periode->nilai->first());
    }

    /** @test */
    public function periode_can_determine_total_nilai()
    {
        $periode = app(PeriodeFactory::class)->withNilai(10)->create();

        $this->assertEquals($periode->totalNilai(), $periode->nilai->sum('nilai'));
    }
    
    /** @test */
    public function periode_can_determine_rata_rata_nilai()
    {
        $periode = app(PeriodeFactory::class)->withNilai(10)->create();

        $this->assertEquals($periode->rataNilai(), round($periode->totalNilai() / $periode->nilai->count(), 2));
    }

    /** @test */
    public function it_can_set_verif_kabag()
    {
        $periode = factory(Periode::class)->create();
        
        $this->assertNull($periode->verif_kabag);

        $periode->verifKabag();
        
        $this->assertNotNull($periode->verif_kabag);
    }

    /** @test */
    public function it_can_set_verif_wadir()
    {
        $periode = factory(Periode::class)->create();
        
        $this->assertNull($periode->verif_wadir);

        $periode->verifWadir();
        
        $this->assertNotNull($periode->verif_wadir);
    }

    /** @test */
    public function it_can_scope_unique()
    {
        $periode = factory(Periode::class)->create();

        $this->assertTrue(Periode::unique($periode->pegawai_id, $periode->bulan_id, $periode->tahun, $periode->tipe)->exists());
    }

    /** @test */
    public function it_can_spoce_milik_user()
    {
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();
        app(PegawaiFactory::class)->withPeriode()->create(['unit_id' => $user->roles[0]->id]);
        factory(Periode::class, 3)->create();

        $this->actingAs($user);
        $this->assertCount(1, Periode::milikUser()->get());
    }

    /** @test */
    public function it_can_scope_terverifikasi_kabag()
    {
        factory(Periode::class)->create();
        factory(Periode::class, 2)->create(['verif_kabag' => now()]);

        $this->assertCount(2, Periode::terverifikasiKabag()->get());
    }

    /** @test */
    public function it_can_scope_terverifikasi_wadir()
    {
        factory(Periode::class)->create();
        factory(Periode::class, 2)->create(['verif_wadir' => now()]);

        $this->assertCount(2, Periode::terverifikasiWadir()->get());
    }

    /** @test */
    public function periode_bisa_diedit_oleh_siapapun_selama_belum_di_verifikasi()
    {
        $user = factory(User::class)->create();
        $periode = factory(Periode::class)->create();
        
        $this->actingAs($user);
        $this->assertFalse($periode->tidakBisaDiedit());
    }
    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_bukan_kabag()
    {
        $user = factory(User::class)->create();
        $periode = factory(Periode::class)->create(['verif_kabag' => now()]);
        
        $this->actingAs($user);
        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = app(UserFactory::class)->withPermission('verif kabag')->create();
        $periode = factory(Periode::class)->create(['verif_kabag' => now()]);
        
        $this->actingAs($user);
        $this->assertFalse($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_diverif_wadir_dan_user_bukan_wadir()
    {
        $user = factory(User::class)->create();
        $periode = factory(Periode::class)->create(['verif_wadir' => now()]);
        
        $this->actingAs($user);
        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_belum_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = app(UserFactory::class)->withPermission('verif wadir')->create();
        $periode = factory(Periode::class)->create();
        
        $this->actingAs($user);
        $this->assertTrue($periode->tidakBisaDiedit());
    }
}
