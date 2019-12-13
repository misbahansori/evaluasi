<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bagian;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AspekTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_bagian()
    {
        $aspek = factory(Aspek::class)->create();

        $this->assertInstanceOf(Bagian::class, $aspek->bagian);
    }
}
