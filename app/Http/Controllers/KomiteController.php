<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domain\Master\Models\Komite;
use App\Http\Controllers\Controller;

class KomiteController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('permission:master komite');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.komite.index', [
            'listKomite' => Komite::orderBy('nama')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:komite',
        ]);

        $komite = Komite::create($validated);

        return redirect()->route('komite.index')
            ->with('success', "Komite $komite->nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function show(Komite $komite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function edit(Komite $komite)
    {
        return view('admin.komite.edit', compact('komite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komite $komite)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('komite')->ignore($komite->id)],
        ]);

        $komite->update($validated);

        return redirect()->route('komite.index')
            ->with('success', "Komite $komite->nama berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komite $komite)
    {
        $komite->aspekKomite->each->delete();
        $komite->delete();

        return redirect()->route('komite.index')
            ->with('success', "Komite $komite->nama berhasil dihapus");
    }
}
