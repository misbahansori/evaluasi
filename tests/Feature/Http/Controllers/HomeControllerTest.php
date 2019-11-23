<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
       
    /** @test */
    public function hanya_user_yang_telah_login_yang_bisa_mengunjungi_home_page()
    {
        $this->get(route('home'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_yang_telah_login_bisa_mengunjungi_home_page()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create())
            ->get(route('home'))
            ->assertOk();
    }
}
