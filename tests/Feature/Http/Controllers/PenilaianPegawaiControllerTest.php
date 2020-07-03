<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use BulanTableSeeder;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\DB;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bagian;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenilaianPegawaiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        
        DB::table('permissions')->insert([
            ['name' => 'verif kabag', 'guard_name' => 'web'],
            ['name' => 'verif wadir', 'guard_name' => 'web'],
        ]);
    }
    
    /** @test */
    public function input_pegawai_index_menampilkan_semua_pegawai()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create())
            ->get(route('penilaian-pegawai.create'))
            ->assertOk()
            ->assertViewIs('admin.penilaian-pegawai.create')
            ->assertViewHas([
                'listPegawai',
                'listBulan',
            ]);
    }

    /** @test */
    public function input_pegawai_index_menampilkan_bulan_tahun_dan_tipe_di_dalam_form()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create())
            ->get(route('penilaian-pegawai.create'))
            ->assertOk()
            ->assertSee('<input type="hidden" name="bulan" value="'.date('n').'">', false)
            ->assertSee('<input type="hidden" name="tahun" value="'.date('Y').'">', false)
            ->assertSee('<input type="hidden" name="tipe" value="bulanan">', false);
    }

    /** @test */
    public function input_pegawai_index_menampilkan_bulan_tahun_dan_tipe_di_dalam_form_sesuai_request()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create())
            ->get(route('penilaian-pegawai.create', [
                'bulan' => 7,
                'tahun' => 2022,
                'tipe' => Periode::PENILAIAN_TAHUNAN,
            ]))
            ->assertOk()
            ->assertSee('<input type="hidden" name="bulan" value="7">', false)
            ->assertSee('<input type="hidden" name="tahun" value="2022">', false)
            ->assertSee('<input type="hidden" name="tipe" value="tahunan">', false);
    }
    
    /** @test */
    public function user_bisa_melakukan_input_penilaian_ke_banyak_pegawai()
    {
        $this->seed(BulanTableSeeder::class);

        $bagian = factory(Bagian::class)->create();
        $aspek = factory(Aspek::class, 4)->create(['bagian_id' => $bagian->id]);
        $listPegawai = factory(Pegawai::class, 2)->create(['bagian_id' => $bagian->id]);

        $this->actingAs(factory(User::class)->create())
            ->post(route('penilaian-pegawai.store', [
                'bulan' => 12,
                'tahun' => 2019,
                'tipe' => 'bulanan',
                'pegawai' => $listPegawai->pluck('id')->toArray(),
            ]))
            ->assertRedirect(route('penilaian-pegawai.index'));
            
        $this->assertEquals(2, Periode::count());
        $this->assertEquals(8, Nilai::count());
    }
}
