<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Bagian;
use Illuminate\Http\Request;

class AspekController extends Controller
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
    public function index()
    {
        $listBagian = Bagian::with('aspek')->orderBy('nama')->get();

        return view('admin.aspek.index', compact('listBagian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listBagian = Bagian::orderBy('nama')->get();

        return view('admin.aspek.create', compact('listBagian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bagian' => 'required|integer|exists:bagian,id',
            'nama' => 'required|string|max:150',
            'kategori' => 'required|in:Profesi,Sikap Kerja,Prestasi Kerja'
        ]);

        $aspek = Aspek::create([
            'bagian_id' => $request->bagian,
            'nama' => $request->nama,
            'kategori' => $request->kategori
        ]);

        return redirect()->route('aspek.index')
            ->with('success', "Aspek penilaian $aspek->nama berhasil ditambahkan");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aspek  $aspek
     * @return \Illuminate\Http\Response
     */
    public function edit(Aspek $aspek)
    {
        $listBagian = Bagian::orderBy('nama')->get();

        return view('admin.aspek.edit', compact('aspek', 'listBagian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aspek  $aspek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aspek $aspek)
    {
        $this->validate($request, [
            'bagian' => 'required|integer|exists:bagian,id',
            'nama' => 'required|string|max:150',
            'kategori' => 'required|in:Profesi,Sikap Kerja,Prestasi Kerja'
        ]);

        $aspek->update([
            'bagian_id' => $request->bagian,
            'nama' => $request->nama,
            'kategori' => $request->kategori
        ]);

        return redirect()->route('aspek.index')
            ->with('success', "Aspek penilaian $aspek->nama berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aspek  $aspek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aspek $aspek)
    {
        //
    }
}
