<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Komite;
use App\Http\Controllers\Controller;
use App\Domain\Master\Models\AspekKomite;
use App\Http\Requests\AspekKomiteRequest;

class AspekKomiteController extends Controller
{
    /**
     * __construct method
     */
    public function __construct()
    {
        $this->middleware('permission:master aspek');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listKomite = Komite::orderBy('nama')->get();

        $listKomite->load(['aspekKomite']);

        return view('admin.aspek-komite.index', compact('listKomite'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aspek-komite.create', [
            'listKomite' => Komite::orderBy('nama')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AspekKomiteRequest $request)
    {
        $aspekKomite = AspekKomite::create($request->validated());

        return redirect()->route('aspek-komite.index')
            ->with('success', "Aspek penilaian $aspekKomite->nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AspekKomite  $aspekKomite
     * @return \Illuminate\Http\Response
     */
    public function show(AspekKomite $aspekKomite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AspekKomite  $aspekKomite
     * @return \Illuminate\Http\Response
     */
    public function edit(AspekKomite $aspekKomite)
    {
        return view('admin.aspek-komite.edit', [
            'listKomite' => Komite::orderBy('nama')->get(),
            'aspekKomite' => $aspekKomite
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AspekKomite  $aspekKomite
     * @return \Illuminate\Http\Response
     */
    public function update(AspekKomiteRequest $request, AspekKomite $aspekKomite)
    {
        $aspekKomite->update($request->validated());

        return redirect()->route('aspek-komite.index')
            ->with('success', "Aspek penilaian $aspekKomite->nama berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AspekKomite  $aspekKomite
     * @return \Illuminate\Http\Response
     */
    public function destroy(AspekKomite $aspekKomite)
    {
        $aspekKomite->delete();

        return redirect()->route('aspek-komite.index')
            ->with('success', "Aspek penilaian $aspekKomite->nama berhasil dihapus.");
    }
}
