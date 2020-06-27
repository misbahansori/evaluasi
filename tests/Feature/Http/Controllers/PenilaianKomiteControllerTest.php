<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\DB;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenilaianKomiteControllerTest extends TestCase
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
    public function hanya_admin_yang_bisa_menambah_penilaian_komite()
    {
        $this->actingAs(factory(User::class)->create());
        
        $this->get(route('penilaian-komite.index'))
            ->assertForbidden();
        $this->get(route('penilaian-komite.create'))
            ->assertForbidden();
        $this->get(route('penilaian-komite.store'))
            ->assertForbidden();
    }

    /** @test */
    public function user_bisa_melihat_daftar_penilaian_komite()
    {
        $this->withoutExceptionHandling();
        $periode = factory(Periode::class)->create([
            'bulan' => date('n') - 1,
            'tahun' => date('Y'),
            'tipe' => Periode::PENILAIAN_KOMITE
        ]);

        factory(Nilai::class, 10)->create(['periode_id' => $periode->id]);

        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->get(route('penilaian-komite.index'))
            ->assertOk()
            ->assertSee($periode->pegawai->nama);
    }

    /** @test */
    public function admin_bisa_menambahkan_penilaian_komite()
    {
        $listPegawai = factory(Pegawai::class, 5)->create();
        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->get(route('penilaian-komite.create'))
            ->assertOk()
            ->assertSee($listPegawai[0]->nama)
            ->assertSee($listPegawai[1]->nama)
            ->assertSee($listPegawai[2]->nama)
            ->assertSee($listPegawai[3]->nama)
            ->assertSee($listPegawai[4]->nama);
    }
}
