<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bagian;
use App\Domain\Master\Models\AspekBagian;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BagianControllerTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function admin_yang_tidak_memiliki_akses_tidak_bisa_membuka_maste_bagian()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('bagian.index'))
            ->assertForbidden();
    }

    /** @test */
    public function admin_bisa_membuka_halaman_master_bagian()
    {
        $listBagian = factory(Bagian::class, 5)->create();
        $user = app(UserFactory::class)->withPermission('master bagian')->create();

        $this->actingAs($user)
            ->get(route('bagian.index'))
            ->assertSee($listBagian[0]->name)
            ->assertSee($listBagian[1]->name)
            ->assertSee($listBagian[2]->name)
            ->assertSee($listBagian[3]->name)
            ->assertSee($listBagian[4]->name);
    }

    /** @test */
    public function admin_bisa_menambahkan_bagian_baru()
    {
        $this->withoutExceptionHandling();
        $attribute = factory(Bagian::class)->raw();
        $user = app(UserFactory::class)->withPermission('master bagian')->create();

        $this->actingAs($user)
            ->post(route('bagian.store'), $attribute)
            ->assertRedirect(route('bagian.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('bagian', $attribute);
    }

    /** @test */
    public function admin_bisa_mengunjungi_halaman_edit()
    {
        $this->withoutExceptionHandling();
        $bagian = factory(Bagian::class)->create();
        $user = app(UserFactory::class)->withPermission('master bagian')->create();

        $this->actingAs($user)
            ->get(route('bagian.edit', $bagian))
            ->assertOk()
            ->assertSee($bagian->nama);
    }

    /** @test */
    public function admin_bisa_mengganti_nama_bagian()
    {
        $this->withoutExceptionHandling();
        $bagian = factory(Bagian::class)->create();

        $attribute = factory(Bagian::class)->raw();
        $user = app(UserFactory::class)->withPermission('master bagian')->create();

        $this->actingAs($user)
            ->put(route('bagian.update', $bagian), $attribute)
            ->assertRedirect(route('bagian.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('bagian', $bagian->toArray());
        $this->assertDatabaseHas('bagian', $attribute);
    }

    /** @test */
    public function admin_bisa_menghapus_bagian()
    {
        $this->withoutExceptionHandling();
        $bagian = factory(Bagian::class)->create();
        factory(Aspek::class, 10)->create(['bagian_id' => $bagian->id]);

        $user = app(UserFactory::class)->withPermission('master bagian')->create();

        $this->actingAs($user)
            ->delete(route('bagian.destroy', $bagian))
            ->assertRedirect(route('bagian.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('bagian', $bagian->toArray());
        $this->assertTrue(Aspek::all()->isEmpty());
    }
}
