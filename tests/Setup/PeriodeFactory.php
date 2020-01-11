<?php 

namespace Tests\Setup;

use App\Domain\User\Models\User;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Catatan;
use App\Domain\Penilaian\Models\Periode;

class PeriodeFactory
{
    protected $nilaiCount;
    protected $catatanCount;

    public function create()
    {
        $periode = factory(Periode::class)->create();

        factory(Nilai::class, $this->nilaiCount)->create(['periode_id' => $periode->id]);
        factory(Catatan::class, $this->catatanCount)->create([
            'periode_id' => $periode->id, 
            'user_id' => factory(User::class)
        ]);

        return $periode;
    }

    public function withNilai($count = 1)
    {
        $this->nilaiCount = $count;

        return $this;
    }

    public function withCatatan($count)
    {
        $this->catatanCount = $count;

        return $this;
    }
}