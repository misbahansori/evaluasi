<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Periode;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TambahPeriodeTest extends TestCase
{
    use RefreshDatabase;
    
    protected $user;
    protected $pegawai;

    public function setUp()
    {
        parent::setUp();
        
       (new \BulanTableSeeder())->run();
       (new \BagianTableSeeder())->run();
       (new \AspekTableSeeder())->run();

        \DB::table('permissions')->insert([
            ['name' => 'tambah periode', 'guard_name' => 'web'],
            ['name' => 'hapus periode', 'guard_name' => 'web'],
        ]);

        $this->user = factory('App\Models\User')->create();
        $this->pegawai = factory('App\Models\Pegawai')->create();

    }

    /** @test */
    public function setiap_menambahkan_periode_harus_unique_tiga_kolom()
    {
        $this->user->givePermissionTo(1);

        $this->actingAs($this->user)
            ->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertSessionHas('success', "Periode Desember 2018 berhasil ditambahkan");
            
        $this->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertSessionHas('danger', "Periode Desember 2018 sudah ada.");

        $this->assertEquals(1, $this->pegawai->periode()->count());
            
    }

    /** @test */
    public function hanya_user_yang_memiliki_pegawai_yang_bisa_menambah_periode()
    {
        $this->user->givePermissionTo(1);

        $this->actingAs($this->user)
            ->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertSessionHas('success', "Periode Desember 2018 berhasil ditambahkan");
            
        $this->assertDatabaseHas('periode', [
            'pegawai_id' => 1,
            'bulan_id' => 12,
            'tahun' => 2018
        ]);
    }

    /** @test */
    public function ketka_menambah_periode_maka_table_nilai_akan_terisi_per_bagiannya()
    {
        $this->user->givePermissionTo(1);

        $this->actingAs($this->user)
            ->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertSessionHas('success', "Periode Desember 2018 berhasil ditambahkan");
            
        $this->assertDatabaseHas('nilai', [
            'periode_id' => 1
        ]);
    }
    /** @test */
    public function hanya_user_yang_berhak_yang_bisa_menghapus_periode()
    {
        $this->actingAs($this->user)
            ->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertStatus(302);
    }
    
    /** @test */
    public function jika_periode_dihapus_maka_nilai_juga_terhapus()
    {
        $this->user->givePermissionTo(1, 2);

        $this->actingAs($this->user)
            ->post(route('periode.store', $this->pegawai->id), [
                'bulan' => 12,
                'tahun' => 2018
            ])->assertSessionHas('success');

        $this->delete(route('periode.destroy', [$this->pegawai->id, 1]))
            ->assertSessionHas('success', 'Periode Desember 2018 berhasil dihapus');
        
        $this->assertDatabaseMissing('nilai', [
            'periode_id' => 1
        ]);
    }
    
}
