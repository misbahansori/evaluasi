<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Aspek;
use Tests\Setup\UserFactory;
use App\Http\Requests\AspekRequest;
use App\Http\Controllers\AspekController;
use JMac\Testing\Traits\HttpTestAssertions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AspekControllerTest extends TestCase
{
    use RefreshDatabase, HttpTestAssertions;

    /** @test */
    public function user_yang_tidak_memiliki_askses_tidak_bisa_membuka_aspek()
    {   
        $this->actingAs(factory(User::class)->create())
            ->get(route('aspek.index'))
            ->assertForbidden();
    }
    
    /** @test */
    public function store_using_validation()
    {
        $this->assertActionUsesFormRequest(
            AspekController::class,
            'store',
            AspekRequest::class
        );
    }
    
    /** @test */
    public function update_using_validation()
    {
        $this->assertActionUsesFormRequest(
            AspekController::class,
            'update',
            AspekRequest::class
        );
    }

    /** @test */
    public function it_can_create_new_aspek()
    {
        $attribute = factory(Aspek::class)->raw();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->post(route('aspek.store'), $attribute)
            ->assertRedirect(route('aspek.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('aspek', $attribute);
    }

    /** @test */
    public function it_can_update_existing_aspek()
    {
        $aspek = factory(Aspek::class)->create();
        $attribute = factory(Aspek::class)->raw();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->put(route('aspek.update', $aspek), $attribute)
            ->assertRedirect(route('aspek.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('aspek', $aspek->toArray());
        $this->assertDatabaseHas('aspek', $attribute);
    }

    /** @test */
    public function aspek_can_be_delete()
    {
        $aspek = factory(Aspek::class)->create();
        $user = app(UserFactory::class)->withPermission('master aspek')->create();

        $this->actingAs($user)
            ->delete(route('aspek.destroy', $aspek))
            ->assertRedirect(route('aspek.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('aspek', $aspek->toArray());
    }
}
