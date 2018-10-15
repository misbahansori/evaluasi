<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeriodeModelTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp()
    {
        parent::setUp();
        
        \DB::table('permissions')->insert([
            ['name' => 'verif kabag', 'guard_name' => 'web'],
            ['name' => 'verif wadir', 'guard_name' => 'web'],
        ]);

    }
    /** @test */
    public function it_has_bulan()
    {
       (new \BulanTableSeeder())->run();

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
    
    /** @test */
    public function periode_bisa_diedit_oleh_siapapun_selama_belum_di_verifikasi()
    {
        $user = factory('App\Models\User')->create();
        $this->actingAs($user);
        
        $periode = factory('App\Models\Periode')->create();
        
        $this->assertFalse($periode->tidakBisaDiedit());
    }
    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_bukan_kabag()
    {
        $user = factory('App\Models\User')->create();
        $this->actingAs($user);

        $periode = factory('App\Models\Periode')->create(['verif_kabag' => 1]);

        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_bisa_diedit_jika_sudah_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = factory('App\Models\User')->create();
        $user->givePermissionTo('verif wadir');
        $this->actingAs($user);

        $periode = factory('App\Models\Periode')->create(['verif_kabag' => 1]);

        $this->assertFalse($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_sudah_diverif_wadir_dan_user_bukan_wadir()
    {
        $user = factory('App\Models\User')->create();
        $this->actingAs($user);

        $periode = factory('App\Models\Periode')->create(['verif_wadir' => 1]);

        $this->assertTrue($periode->tidakBisaDiedit());
    }

    /** @test */
    public function periode_tidak_bisa_diedit_jika_belum_di_verif_kabag_dan_user_adalah_wadir()
    {
        $user = factory('App\Models\User')->create();
        $this->actingAs($user);
        $user->givePermissionTo('verif wadir');

        $periode = factory('App\Models\Periode')->create();

        $this->assertTrue($periode->tidakBisaDiedit());
    }
}
