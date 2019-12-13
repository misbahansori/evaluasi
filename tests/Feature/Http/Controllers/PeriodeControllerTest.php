<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use BulanTableSeeder;
use PermissionsTableSeeder;
use Tests\Setup\UserFactory;
use Tests\Setup\PegawaiFactory;
use App\Domain\User\Models\User;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeriodeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_yang_tidak_punya_akses_tidak_bisa_menambahkan_periode()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->post(route('periode.store', $pegawai))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_yang_tidak_punya_akses_tidak_bisa_melihat_detail_periode()
    {
        $pegawai = app(PegawaiFactory::class)->withPeriode()->create();

        $this->get(route('periode.show', [$pegawai, $pegawai->periode->first()]))
            ->assertRedirect(route('login'));

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('periode.show', [$pegawai, $pegawai->periode->first()]))
            ->assertForbidden();
    }

    /** @test */
    public function hanya_user_yang_memiliki_akses_yang_bisa_melihat_detail_periode()
    {
        $this->seed(BulanTableSeeder::class);
        $this->seed(PermissionsTableSeeder::class);
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();
        $pegawai = app(PegawaiFactory::class)->withPeriode()->create(['unit_id' => $user->roles[0]->id]);
        
        $this->actingAs($user)
            ->get(route('periode.show', [$pegawai, $pegawai->periode->first()]))
            ->assertOk()
            ->assertSee($pegawai->nama);
    }

    /** @test */
    public function tidak_bisa_menambah_periode_jika_pegawai_tidak_memiliki_bagian()
    {
        $user = app(UserFactory::class)->withPermission('tambah periode')->create();
        $pegawai = factory(Pegawai::class)->create(['bagian_id' => null]);

        $this->actingAs($user)
            ->post(route('periode.store', $pegawai))
            ->assertSessionHas('danger');
    }

    /** @test */
    public function tidak_bisa_menambah_periode_jika_periode_sudah_ada()
    {
        $this->withoutExceptionHandling();
        $this->seed(BulanTableSeeder::class);
        $user = app(UserFactory::class)->withPermission('tambah periode')->create();
        $periode = factory(Periode::class)->create([
            'bulan_id'   => 12,
            'tahun'      => 2019,
            'tipe'       => 'bulanan'
        ]);
        
        $this->actingAs($user)
            ->post(route('periode.store', $periode->pegawai), [
                'bulan' => 12,
                'tahun'    => 2019,
                'tipe'     => 'bulanan'
            ])
            ->assertSessionHas('danger');
    }

    /** @test */
    public function hanya_user_yang_memiliki_akses_yang_bisa_menghapus_periode()
    {
        $pegawai = app(PegawaiFactory::class)->withPeriode()->create();
        
        $this->delete(route('periode.destroy', [$pegawai, $pegawai->periode->first()]))
            ->assertRedirect(route('login'));
        
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->delete(route('periode.destroy', [$pegawai, $pegawai->periode->first()]))
            ->assertForbidden();
    }

    /** @test */
    public function delete_periode_menghapus_nilai()
    {
        $this->seed(BulanTableSeeder::class);
        $this->seed(PermissionsTableSeeder::class);
        $user = app(UserFactory::class)->withRole('Ruang IT')->withPermission('hapus periode')->create();
        $pegawai = app(PegawaiFactory::class)->withPeriode()->withNilai()->create(['unit_id' => $user->roles[0]->id]);

        $this->assertTrue(Nilai::all()->isNotEmpty());

        $this->actingAs($user)
            ->delete(route('periode.destroy', [$pegawai, $pegawai->periode->first()]))
            ->assertRedirect(route('pegawai.show', $pegawai));
            
        $this->assertDatabaseMissing('periode', $pegawai->periode->first()->getAttributes());
        $this->assertTrue(Nilai::all()->isEmpty());
    }
}
