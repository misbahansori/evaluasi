<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class VerifWadirController extends Controller
{
    public function store(Periode $periode)
    {
        if (!$periode->verif_kabag) {
            return redirect()->back()->with('danger', 'Belum di verifikasi Kabag/Kabid');
        }
        $periode->verifWadir();

        return redirect()->back()->with('success', 'Berhasil di verifikasi');

    }
}
