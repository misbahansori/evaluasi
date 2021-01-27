<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\UserFactory;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function user_bisa_login_dengan_user_name_dan_password()
    {
        $user = factory(User::class)->create();

        $this->get('/login')
            ->assertStatus(200);

        
    }
    
    /** @test */
    public function admin_can_delete_user()
    {
        $user = app(UserFactory::class)->withPermission('master user')->create();

        $this->actingAs($user)
            ->delete(route('user.destroy', $user))
            ->assertSessionHas('success')
            ->assertRedirect(route('user.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
