<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Nilai;
use App\Models\Periode;
use Illuminate\Http\Request;

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
        if ($periode->tidakBisaDiedit()) {
            return back()
            ->with('danger', 'Nilai tidak bisa diedit');
        }
        
        foreach ($request->all() as $key => $value) {
            Nilai::where('id', $key)
                ->update(['nilai' => $value]);
        }

        $periode->update(['updated_at' => Carbon::now()]);

        return back()
            ->with('success', 'Nilai berhasil disimpan.');
    }
}
