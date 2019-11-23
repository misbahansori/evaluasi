<?php

namespace Tests\Feature\Http\Controller;

use Tests\TestCase;
use App\Models\Pegawai;
use Tests\Setup\UserFactory;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PegawaiControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function hanya_user_yang_telah_login_yang_bisa_mengunjungi_halaman_pegawai()
    {
        $this->get(route('pegawai.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_hanya_bisa_mengkases_pegawai_yang_ada_dibagiannya_saja()
    {
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();
        $pegawai = factory(Pegawai::class)->create(['unit_id' => $user->roles[0]->id]);
        $pegawaiLain = factory(Pegawai::class)->create();

        $this->actingAs($user)
            ->get(route('pegawai.index'))
            ->assertSee($pegawai->nama)
            ->assertDontSee($pegawaiLain->nama);
    }

    /** @test */
    public function hanya_user_yang_punya_akses_yang_bisa_menambah_pegawai()
    {
        $user = app(UserFactory::class)->withPermission('tambah pegawai')->create();

        $this->get(route('pegawai.create'))
            ->assertRedirect(route('login'));

        $this->actingAs($user)
            ->get(route('pegawai.create'))
            ->assertOk();
    }

    /** @test */
    public function user_bisa_menyimpan_pegawai()
    {
        $this->withoutmiddleware();
        $user = app(UserFactory::class)->withPermission('tambah pegawai')->create();

        $pegawai = factory(Pegawai::class)->raw();

        $this->actingAs($user)
            ->post(route('pegawai.store', $pegawai))
            ->assertRedirect(route('pegawai.index'))
            ->assertSessionHas('success');
    }

    /** @test */
    public function user_yang_tidak_punya_akses_tidak_bisa_melihat_detail_pegawai()
    {
        $user = app(UserFactory::class)->create();
        $pegawai = factory(Pegawai::class)->create();

        $this->actingAs($user)
            ->get(route('pegawai.show', $pegawai))
            ->assertForbidden();
    }

    /** @test */
    public function user_yang_punya_akses_bisa_melihat_detail_pegawai()
    {
        $user = app(UserFactory::class)->withRole('Ruang IT')->create();
        $pegawai = factory(Pegawai::class)->create(['unit_id' => $user->roles[0]->id ]);

        $this->actingAs($user)
            ->get(route('pegawai.show', $pegawai))
            ->assertOk()
            ->assertSee($pegawai->nama);
    }

    /** @test */
    public function user_yang_tidak_punya_akses_tidak_bisa_mengedit_pegawai()
    {
        $user = app(UserFactory::class)->create();
        $pegawai = factory(Pegawai::class)->create();

        $this->actingAs($user)
            ->get(route('pegawai.edit', $pegawai))
            ->assertForbidden();
    }

    /** @test */
    public function user_yang_punya_akses_bisa_mengedit_pegawai()
    {
        $user = app(UserFactory::class)->withRole('Ruang IT')->withPermission('edit pegawai')->create();
        $pegawai = factory(Pegawai::class)->create(['unit_id' => $user->roles[0]->id ]);

        $this->actingAs($user)
            ->get(route('pegawai.edit', $pegawai))
            ->assertOk()
            ->assertSee($pegawai->name);
    }

    /** @test */
    public function user_yang_punya_akses_bisa_menyimpan_editan_pegawai()
    {
        // $this->withoutExceptionHandling();
        $user = app(UserFactory::class)->withRole('Ruang IT')->withPermission('edit pegawai')->create();
        $pegawai = factory(Pegawai::class)->create(['unit_id' => $user->roles[0]->id ]);
        $attribute = factory(Pegawai::class)->raw();

        $this->actingAs($user)
            ->from(route('pegawai.edit', $pegawai))
            ->put(route('pegawai.update', $pegawai), $attribute)
            ->assertRedirect(route('pegawai.show', $pegawai->id))
            ->assertSessionHas('success');
    }
}
