<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NilaiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_periode()
    {
        $nilai = factory(Nilai::class)->create();

        $this->assertInstanceOf(Periode::class, $nilai->periode);
    }
}
