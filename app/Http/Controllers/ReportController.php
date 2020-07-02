<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Penilaian\Reports\HasilEvaluasi;
use App\Domain\Penilaian\Reports\HasilEvaluasiKomite;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $tipe)
    {
        $reports = [
            'bulanan' => HasilEvaluasi::class,
            'tahunan' => HasilEvaluasi::class,
            'komite' => HasilEvaluasiKomite::class,
        ];

        $report = new $reports[$tipe]($request);
       
        return  $report->pdf();
    }
}
