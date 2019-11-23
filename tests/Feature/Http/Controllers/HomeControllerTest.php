<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    /** @test */
    public function hanya_user_yang_telah_login_yang_bisa_mengunjungi_home_page()
    {
        $this->get(route('home'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_yang_telah_login_bisa_mengunjungi_home_page()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('home'))
            ->assertOk();
    }
}
