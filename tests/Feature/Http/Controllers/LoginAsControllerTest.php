<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginAsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function hanya_admin_yang_bisa_membuka_halaman_login_as()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('login-as.index'))
            ->assertForbidden();
    }

    /** @test */
    public function admin_bisa_membuka_halaman_login_sebgagai_user_lain()
    {
        $users = factory(User::class, 3)->create();
        $user = app(UserFactory::class)->withPermission('login-as')->create();

        $this->actingAs($user)
            ->get(route('login-as.index'))
            ->assertOk()
            ->assertViewHas('users')
            ->assertSee($users[0]->name)
            ->assertSee($users[1]->name)
            ->assertSee($users[2]->name);
    }

    /** @test */
    public function admin_bisa_login_sebagai_user_lain()
    {
        $user = app(UserFactory::class)->withPermission('login-as')->create();
        $newUser = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('login-as.store'), [
                'user_id' => $newUser->id
            ])
            ->assertRedirect();

        $this->assertAuthenticatedAs($newUser);
    }
}
