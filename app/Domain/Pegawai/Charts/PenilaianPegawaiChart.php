<?php

namespace App\Domain\Pegawai\Charts;

use Illuminate\Http\Request;
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
    public function __construct(Request $request, Pegawai $pegawai)
    {
        parent::__construct();

        $periode = Periode::query()
            ->with('bulan')
            ->wherePegawaiId($pegawai->id)
            ->whereTipe('bulanan')
            ->latest()
            ->limit(12)
            ->get()
            ->reverse(); 

        $label = $periode->map(function($item) {
            return $item->bulan->nama_singkat . ' '.$item->tahun;
        })->values();

        $nilai = $periode->map(function($item) {
            return $item->rataNilai();
        })->values();

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
