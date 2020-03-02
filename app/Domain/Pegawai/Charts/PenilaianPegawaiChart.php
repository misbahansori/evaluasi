<?php

namespace App\Domain\Pegawai\Charts;

use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class PenilaianPegawaiChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct(Pegawai $pegawai)
    {
        parent::__construct();

        $periode = Periode::query()
            ->wherePegawaiId($pegawai->id)
            ->whereTahun(date('Y'))
            ->get();

        $label = $periode->map(function($item) {
            return $item->bulan->nama_singkat . ' '.$item->tahun;
        });

        $nilai = $periode->map(function($item) {
            return $item->rataNilai();
        });

        $this->labels($label);
        $this->dataset($pegawai->nama, 'line', $nilai);
        $this->options([
            'scales' => [
                'yAxes' => [
                    [
                        'display' => true,
                        'ticks' => [
                            'suggestedMin' => 0,
                            'suggestedMax' => 5,
                        ]
                    ]
                ]
            ]
        ]);
    }
}
