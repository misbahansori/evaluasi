<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Aspek;
use App\Http\Requests\AspekRequest;
use App\Domain\Master\Models\Bagian;
use App\Http\Controllers\Controller;

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
    public function index(Request $request)
    {
        $listBagian = Bagian::orderBy('nama')->get();

        $tipe = $request->tipe ?? 'bulanan';
         
        $listBagian->load(['aspek' => function($query) use ($tipe) {
            $query->whereTipe($tipe);
        }]);

        return view('admin.aspek.index', compact('listBagian', 'tipe'));
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
     * @param  \App\Http\Requests\AspekRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AspekRequest $request)
    {
        $aspek = Aspek::create($request->validated());

        return redirect()->route('aspek.index')
            ->with('success', "Aspek penilaian $aspek->nama berhasil ditambahkan");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Master\Models\Aspek  $aspek
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
     * @param  \App\Domain\Master\Models\Aspek  $aspek
     * @return \Illuminate\Http\Response
     */
    public function update(AspekRequest $request, Aspek $aspek)
    {
        $aspek->update($request->validated());

        return redirect()->route('aspek.index')
            ->with('success', "Aspek penilaian $aspek->nama berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Master\Models\Aspek  $aspek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aspek $aspek)
    {
        $aspek->delete();
        
        return redirect()
            ->route('aspek.index')
            ->with('success', "Aspek $aspek->nama berhasil dihapus.");
    }
}
