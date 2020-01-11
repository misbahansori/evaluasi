<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domain\Penilaian\Models\Catatan;
use App\Domain\Penilaian\Models\Periode;

class CatatanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Periode $periode, Request $request)
    {
        $request->validate([
            'tipe' => 'required',
            'isi' => 'required',
        ]);

        $periode->catatan()->create([
            'tipe' => $request->tipe,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->back()
            ->with('success', "Catatan $periode->tipe berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function show(Catatan $catatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Catatan $catatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catatan $catatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catatan  $catatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catatan $catatan)
    {
        //
    }
}
