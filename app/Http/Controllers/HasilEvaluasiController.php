<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class HasilEvaluasiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Periode $periode)
    {
        $pdf = \PDF::loadView('admin.reports.hasil-evaluasi', compact('periode'));
        
        return $pdf->stream('invoice.pdf');
    }
}
