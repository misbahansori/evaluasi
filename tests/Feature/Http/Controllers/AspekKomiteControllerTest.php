<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use App\Domain\Master\Models\Komite;
use App\Domain\Master\Models\AspekKomite;
use App\Http\Requests\AspekKomiteRequest;
use JMac\Testing\Traits\HttpTestAssertions;
use App\Http\Controllers\AspekKomiteController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AspekKomiteControllerTest extends TestCase
{
    use RefreshDatabase, HttpTestAssertions;

    /** @test */
    public function user_yang_tidak_memiliki_askses_tidak_bisa_membuka_aspek()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('aspek-komite.index'))
            ->assertForbidden();
    }

    /** @test */
    public function user_bisa_melihat_komite_beserta_aspeknya()
    {
        $aspek = factory(AspekKomite::class)->create();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->get(route('aspek-komite.index'))
            ->assertOk()
            ->assertSee($aspek->nama)
            ->assertSee($aspek->komite->nama);
    }

    /** @test */
    public function user_bisa_membuka_halamam_tambah_aspek_komite()
    {
        $listKomite = factory(Komite::class, 3)->create();

        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->get(route('aspek-komite.create'))
            ->assertOk()
            ->assertSee($listKomite[0]->name)
            ->assertSee($listKomite[1]->name)
            ->assertSee($listKomite[2]->name);
    }

    /** @test */
    public function user_bisa_menyimpan_aspek_komite()
    {
        $attribute = factory(AspekKomite::class)->raw();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->post(route('aspek-komite.store'), $attribute)
            ->assertRedirect(route('aspek-komite.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('aspek_komite', $attribute);
    }

    /** @test */
    public function store_using_validation()
    {
        $this->assertActionUsesFormRequest(
            AspekKomiteController::class,
            'store',
            AspekKomiteRequest::class
        );
    }

    /** @test */
    public function user_bisa_mengunjungi_halaman_edit_aspek_komite()
    {
        $this->withoutExceptionHandling();
        $aspekKomite = factory(AspekKomite::class)->create();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->get(route('aspek-komite.edit', $aspekKomite))
            ->assertSee($aspekKomite->nama)
            ->assertSee($aspekKomite->kategori)
            ->assertSee($aspekKomite->komite->nama);
    }

    /** @test */
    public function user_bisa_mengupdate_aspek_komite()
    {
        $this->withoutExceptionHandling();
        $attribute = factory(AspekKomite::class)->raw();
        $aspekKomite = factory(AspekKomite::class)->create();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->put(route('aspek-komite.update', $aspekKomite), $attribute)
            ->assertRedirect(route('aspek-komite.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('aspek_komite', $aspekKomite->toArray());
        $this->assertDatabaseHas('aspek_komite', $attribute);
    }

    /** @test */
    public function update_using_validation()
    {
        $this->assertActionUsesFormRequest(
            AspekKomiteController::class,
            'update',
            AspekKomiteRequest::class
        );
    }

    /** @test */
    public function user_bisa_menghapus_aspek_komite()
    {
        $aspekKomite = factory(AspekKomite::class)->create();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->delete(route('aspek-komite.destroy', $aspekKomite))
            ->assertRedirect(route('aspek-komite.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('aspek_komite', $aspekKomite->toArray());
    }
}
