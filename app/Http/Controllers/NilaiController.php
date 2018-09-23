<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Nilai::where('id', $key)
                ->update(['nilai' => $value]);
        }

        return back()
            ->with('success', 'Nilai berhasil disimpan.');
    }
}
