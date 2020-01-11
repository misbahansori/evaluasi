<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use PermissionsTableSeeder;
use Tests\Setup\UserFactory;
use Tests\Setup\PegawaiFactory;
use App\Domain\User\Models\User;
use App\Domain\Penilaian\Models\Catatan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatatanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function periode_show_menampilkan_catatan()
    {
        $this->seed(PermissionsTableSeeder::class);
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();
        $pegawai = app(PegawaiFactory::class)->withPeriode()->create([
            'unit_id' => $user->roles()->first()->id
        ]);
        $catatan = factory(Catatan::class)->create([
            'periode_id' => $pegawai->periode->first()->id, 
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('periode.show', [$pegawai->id, $pegawai->periode->first()->id]))
            ->assertOk()
            ->assertSeeInOrder([
                $catatan->tipe,
                $catatan->isi,
                $catatan->user->name
            ]);
    }
   
    /** @test */
    public function user_bisa_menambah_catatan_di_dalam_periode()
    {
        $attribute = factory(Catatan::class)->raw();

        $this->actingAs(factory(User::class)->create())
            ->post(route('catatan.store', $attribute['periode_id']), $attribute)
            ->assertSessionHas('success');

        $this->assertDatabaseHas('catatan', $attribute);
    }

    /** @test */
    public function tipe_catatan_tidak_boleh_kosong()
    {
        $attribute = factory(Catatan::class)->raw(['tipe' => '']);

        $this->actingAs(factory(User::class)->create())
            ->post(route('catatan.store', $attribute['periode_id']), $attribute)
            ->assertSessionHasErrors('tipe');
    }
    /** @test */
    public function isi_catatan_tidak_boleh_kosong()
    {
        $attribute = factory(Catatan::class)->raw(['isi' => '']);

        $this->actingAs(factory(User::class)->create())
            ->post(route('catatan.store', $attribute['periode_id']), $attribute)
            ->assertSessionHasErrors('isi');
    }
    /** @test */
    public function user_catatan_diisi_dengan_user_masuk()
    {
        $attribute = factory(Catatan::class)->raw();

        $this->actingAs($user = factory(User::class)->create())
            ->post(route('catatan.store', $attribute['periode_id']), $attribute);

        $this->assertDatabaseHas('catatan', [
            'user_id' => $user->id
        ]);
    }
}
