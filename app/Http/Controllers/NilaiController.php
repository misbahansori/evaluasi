<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;

class NilaiController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        if (!$periode->bisaDiedit()) {
            return back()
            ->with('danger', 'Nilai tidak bisa diedit');
        }
        
        foreach ($request->all() as $key => $value) {
            Nilai::where('id', $key)
                ->update(['nilai' => $value]);
        }

        return back()
            ->with('success', 'Nilai berhasil disimpan.');
    }
}
