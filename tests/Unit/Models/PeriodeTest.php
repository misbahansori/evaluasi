<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Aspek;
use App\Models\Bulan;
use App\Models\Nilai;
use App\Models\Bagian;
use App\Models\Pegawai;
use App\Models\Periode;
use Tests\Setup\PeriodeFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
    public function periode_bisa_diedit_oleh_siapapun_selama_belum_di_verifikasi()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        
        $periode = factory(Periode::class)->create();
        
        $this->assertFalse($periode->tidakBisaDiedit());
    }
    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_bukan_kabag()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $periode = factory(Periode::class)->create(['verif_kabag' => 1]);

        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('verif wadir');
        $this->actingAs($user);

        $periode = factory(Periode::class)->create(['verif_kabag' => 1]);

        $this->assertFalse($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_diverif_wadir_dan_user_bukan_wadir()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $periode = factory(Periode::class)->create(['verif_wadir' => 1]);

        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_belum_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->givePermissionTo('verif wadir');

        $periode = factory(Periode::class)->create();

        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_bisa_menampilkan_nilai_rata_rata()
    {
        $bagian  = factory(Bagian::class)->create();
        $aspek   = factory(Aspek::class, 20)->create(['bagian_id' => $bagian->id]);
        $pegawai = factory(Pegawai::class)->create(['bagian_id' => $bagian->id]);
        $periode = factory(Periode::class)->create(['pegawai_id' => $pegawai->id]);

        $pegawai->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create(['aspek' => $item->nama, 'kategori' => $item->kategori]);
        });
        
        $this->assertEquals(0, $periode->rataNilai());
        
        $nilai = Nilai::first()->update(['nilai' => 5]);
        
        $this->assertEquals($periode->totalNilai() / $periode->nilai()->count(), $periode->rataNilai());
    }
}
