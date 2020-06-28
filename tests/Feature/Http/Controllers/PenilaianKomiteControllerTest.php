<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\DB;
use App\Domain\Master\Models\Komite;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use App\Domain\Master\Models\AspekKomite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenilaianKomiteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
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
    public function admin_bisa_melihat_halaman_untuk_menambahkan_penilaian_komite()
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

    /** @test */
    public function user_bisa_menambahkan_penilaian_komite()
    {
        $this->withoutExceptionHandling();

        $komite = factory(Komite::class)->create(['nama' => 'PPI']);
        $aspekKomite = factory(AspekKomite::class, 5)->create(['komite_id' => $komite->id]);
        $listPegawai = factory(Pegawai::class, 3)->create(['komite_id' => $komite->id]);
        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->post(route('penilaian-komite.store'), [
                'bulan' => date('n'),
                'tahun' => date('Y'),
                'pegawai' => $listPegawai->pluck('id')->toArray()
            ])
            ->assertSessionHas('success');

        foreach ($listPegawai as $pegawai) {
            $this->assertDatabaseHas('periode', [
                'bulan_id' => date('n'),
                'tahun' => date('Y'),
                'tipe' => Periode::PENILAIAN_KOMITE,
                'pegawai_id' => $pegawai->id
            ]);
        }
        $this->assertEquals(15, Nilai::count());
    }

    /** @test */
    public function menampilkan_pesan_error_jika_aspek_komite_masih_kosong()
    {
        $komite = factory(Komite::class)->create(['nama' => 'PPI']);
        $pegawai = factory(Pegawai::class)->create(['komite_id' => $komite->id]);
        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->post(route('penilaian-komite.store'), [
                'bulan' => date('n'),
                'tahun' => date('Y'),
                'pegawai' => [$pegawai->id]
            ])->assertSessionHas('danger');

        $this->assertDatabaseMissing('periode', [
            'bulan' => date('n'),
            'tahun' => date('Y'),
            'pegawai' => $pegawai->id,
            'tipe' => Periode::PENILAIAN_KOMITE
        ]);
    }

    /** @test */
    public function menampilkan_error_jika_pegawai_tidak_ditemukan()
    {
        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->post(route('penilaian-komite.store'), [
                'bulan' => date('n'),
                'tahun' => date('Y'),
                'pegawai' => [1]
            ])->assertNotFound();
    }

    /** @test */
    public function menampilkan_error_jika_sudah_ada_periode_dengan_bulan_dan_tahun_yang_sama()
    {
        $this->withoutExceptionHandling();
        $komite = factory(Komite::class)->create(['nama' => 'PPI']);
        $pegawai = factory(Pegawai::class)->create(['komite_id' => $komite->id]);
        $periode = factory(Periode::class)->create([
            'bulan' => date('n'),
            'tahun' => date('Y'),
            'pegawai_id' => $pegawai->id,
            'tipe' => Periode::PENILAIAN_KOMITE
        ]);
        
        $user = app(UserFactory::class)->withPermission('tambah penilaian komite')->create();

        $this->actingAs($user)
            ->post(route('penilaian-komite.store'), [
                'bulan' => date('n'),
                'tahun' => date('Y'),
                'pegawai' => [$periode->pegawai_id]
            ])->assertSessionHas('danger');
    }
}
