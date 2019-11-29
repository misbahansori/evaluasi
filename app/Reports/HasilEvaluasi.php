<?php

namespace App\Reports;

use App\Models\Periode;
use Illuminate\Http\Request;

class HasilEvaluasi
{
    protected $request;

    /**
    * Instantiate a new class instance.
    * @param \Illuminate\Http\Request $request
    * @return void
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Export PDF
     *
     * @return void
     */
    public function pdf()
    {
        $periode = Periode::findOrFail($this->request->periode_id);
        
        $periode->load('pegawai', 'nilai');

        $pdf = \PDF::loadView('admin.reports.hasil-evaluasi', compact('periode'));
        
        return $pdf->stream('invoice.pdf');
    }
}