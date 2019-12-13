<?php

namespace Tests\Setup;

use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;

class PegawaiFactory 
{ 
    protected $periodeCount = 0;
    protected $nilaiCount = 0;

    public function create($attribute = [])
    {
        $pegawai = factory(Pegawai::class)->create($attribute);

        if ($this->periodeCount > 0) {
            $periode = factory(Periode::class, $this->periodeCount)->create(['pegawai_id' => $pegawai->id]);

            factory(Nilai::class, $this->nilaiCount)->create(['periode_id' => $periode->first()->id]);
        }
        
        return $pegawai;
    }

    public function withPeriode($count = 1)
    {
        $this->periodeCount = $count;

        return $this;
    }

    public function withNilai($count = 10)
    {
        $this->nilaiCount = $count;

        return $this;
    }
}