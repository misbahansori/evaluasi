<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domain\Master\Models\Bagian;
use App\Http\Controllers\Controller;

class BagianController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('permission:master bagian');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bagian.index', [
            'listBagian' => Bagian::orderBy('nama')->get()
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
            'nama' => 'required|string|min:3|max:255',
        ]);

        $bagian = Bagian::create($validated);

        return redirect()->route('bagian.index')
            ->with('success', "Komite $bagian->nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function show(Bagian $bagian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function edit(Bagian $bagian)
    {
        return view('admin.bagian.edit', [
            'bagian' => $bagian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bagian $bagian)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('bagian')->ignore($bagian->id)],
        ]);

        $bagian->update($validated);

        return redirect()->route('bagian.index')
            ->with('success', "Komite $bagian->nama berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian)
    {
        $bagian->aspek->each->delete();
        $bagian->delete();

        return redirect()->route('bagian.index')
            ->with('success', "Komite $bagian->nama berhasil dihapus");
    }
}
