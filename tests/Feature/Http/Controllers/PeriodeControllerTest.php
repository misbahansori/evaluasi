<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Nilai;
use BulanTableSeeder;
use App\Models\Pegawai;
use PermissionsTableSeeder;
use Tests\Setup\UserFactory;
use Tests\Setup\PegawaiFactory;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->actingAs($user)
            ->delete(route('periode.destroy', [$pegawai, $pegawai->periode->first()]))
            ->assertRedirect(route('pegawai.show', $pegawai));
            
        $this->assertDatabaseMissing('periode', $pegawai->periode->first()->getAttributes());
        $this->assertTrue(Nilai::all()->isEmpty());
    }
}
