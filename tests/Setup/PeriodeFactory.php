<?php 

namespace Tests\Setup;

use App\Models\Nilai;
use App\Models\Periode;

class PeriodeFactory
{
    protected $nilaiCount;

    public function create()
    {
        $periode = factory(Periode::class)->create();

        factory(Nilai::class, $this->nilaiCount)->create(['periode_id' => $periode->id]);

        return $periode;
    }

    public function withNilai($count = 1)
    {
        $this->nilaiCount = $count;

        return $this;
    }
}