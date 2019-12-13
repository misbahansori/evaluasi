<?php

namespace Tests\Unit\Domain\Master\Models;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bagian;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BagianTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_aspek()
    {
        $bagian = factory(Bagian::class)->create();
        factory(Aspek::class, 2)->create(['bagian_id' => $bagian->id]);
     
        $this->assertInstanceOf(Collection::class, $bagian->aspek);
        $this->assertInstanceOf(Aspek::class, $bagian->aspek->first());
    }
}
