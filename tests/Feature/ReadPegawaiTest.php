<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadPegawaiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_unauthenticated_user_can_not_browse_pegawai()
    {
        $pegawai = factory('App\Models\Pegawai')->create();

        $this->get('/pegawai')
            ->assertRedirect('/login');
    }
    
    /** @test */
    public function an_authenticated_user_can_browse_pegawai()
    {
        $user = factory('App\Models\User')->create();
        
        $pegawai = factory('App\Models\Pegawai')->create();

        $this->actingAs($user)
            ->get('/pegawai')
            ->assertOk();
    }

}
