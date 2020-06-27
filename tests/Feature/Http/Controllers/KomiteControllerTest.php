<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use App\Domain\Master\Models\Komite;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KomiteControllerTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function user_yang_tidak_memiliki_akses_tidak_bisa_membuka_maste_komite()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('komite.index'))
            ->assertForbidden();
    }

    /** @test */
    public function user_bisa_membuka_halaman_master_komite()
    {
        $listKomite = factory(Komite::class, 5)->create();
        $user = app(UserFactory::class)->withPermission('master komite')->create();

        $this->actingAs($user)
            ->get(route('komite.index'))
            ->assertSee($listKomite[0]->name)
            ->assertSee($listKomite[1]->name)
            ->assertSee($listKomite[2]->name)
            ->assertSee($listKomite[3]->name)
            ->assertSee($listKomite[4]->name);
    }

    /** @test */
    public function user_bisa_menambahkan_komite_baru()
    {
        $this->withoutExceptionHandling();
        $attribute = factory(Komite::class)->raw();
        $user = app(UserFactory::class)->withPermission('master komite')->create();

        $this->actingAs($user)
            ->post(route('komite.store'), $attribute)
            ->assertRedirect(route('komite.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('komite', $attribute);
    }

    /** @test */
    public function user_bisa_mengunjungi_halaman_edit()
    {
        $this->withoutExceptionHandling();
        $komite = factory(Komite::class)->create();
        $user = app(UserFactory::class)->withPermission('master komite')->create();

        $this->actingAs($user)
            ->get(route('komite.edit', $komite))
            ->assertOk()
            ->assertSee($komite->nama);
    }

    /** @test */
    public function user_bisa_mengganti_nama_komite()
    {
        $this->withoutExceptionHandling();
        $komite = factory(Komite::class)->create();

        $attribute = factory(Komite::class)->raw();
        $user = app(UserFactory::class)->withPermission('master komite')->create();

        $this->actingAs($user)
            ->put(route('komite.update', $komite), $attribute)
            ->assertRedirect(route('komite.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('komite', $komite->toArray());
        $this->assertDatabaseHas('komite', $attribute);
    }
}
