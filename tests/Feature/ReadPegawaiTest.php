<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Unit;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadPegawaiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function daftar_pegawai_hanya_bisa_dilihat_user_yg_sudah_login()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->get('/pegawai')
            ->assertRedirect('/login');
    }
    
    /** @test */
    public function user_hanya_bisa_mengkakses_pegawai_di_bagiannya_saja()
    {
        $unit = factory(Unit::class)->create();
        $user = factory(User::class)->create();
        $user->assignRole($unit->id);
        
        $pegawai = factory(Pegawai::class)->create(['unit_id' => $unit->id]);

        $this->actingAs($user)
            ->get(route('pegawai.index'))
            ->assertSee($pegawai->nama);
    }

    /** @test */
    public function user_tidak_bisa_melihat_pegawai_yang_bukan_bagiannya()
    {
        $unit = factory(Unit::class, 2)->create();
        $user = factory(User::class)->create();
        $user->assignRole(1);
        
        $pegawai = factory(Pegawai::class)->create(['unit_id' => 2]);
        
        $this->actingAs($user)
            ->get(route('pegawai.show', $pegawai->id))
            ->assertStatus(403);
    }

}
