<?php

namespace App\Domain\Pegawai\Charts;

use App\Domain\Pegawai\Models\Pegawai;
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

        $pegawai->load('periode.nilai');

        $periode = $pegawai->periode->filter(function($item) {
            return $item->tahun == date('Y');
        });

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
