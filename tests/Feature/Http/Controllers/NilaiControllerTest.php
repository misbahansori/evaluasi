<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Tests\Setup\PeriodeFactory;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\DB;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NilaiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        
        (new \PermissionsTableSeeder())->run();
    }

    /** @test */
    public function user_bisa_mengupdate_nilai()
    {
        $this->withoutExceptionHandling();
        $periode = factory(Periode::class)->create();
        $nilai1 = factory(Nilai::class)->create(['periode_id' => $periode->id, 'nilai' => 0]);
        $nilai2 = factory(Nilai::class)->create(['periode_id' => $periode->id, 'nilai' => 1]);
        $nilai3 = factory(Nilai::class)->create(['periode_id' => $periode->id, 'nilai' => 2]);

        $this->actingAs(factory(User::class)->create())
            ->put(route('nilai.update', $periode), [
                $nilai1->id => 5,
                $nilai2->id => 4,
                $nilai3->id => 3,
            ])
            ->assertSessionHas('success');

        $this->assertDatabaseHas('nilai', [
            'id' => $nilai1->id,
            'nilai' => 5,
        ]);
        $this->assertDatabaseHas('nilai', [
            'id' => $nilai2->id,
            'nilai' => 4,
        ]);
        $this->assertDatabaseHas('nilai', [
            'id' => $nilai3->id,
            'nilai' => 3,
        ]);
    }
}
