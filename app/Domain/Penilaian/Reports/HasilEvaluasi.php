<?php

namespace App\Domain\Penilaian\Reports;

use Illuminate\Http\Request;
use App\Domain\Penilaian\Models\Periode;

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

        $pdf = \PDF::loadView('admin.reports.hasil-evaluasi', compact('periode'))
            ->setPaper([0, 0, 595.4, 935.5]);
        
        return $pdf->stream('invoice.pdf');
    }
}