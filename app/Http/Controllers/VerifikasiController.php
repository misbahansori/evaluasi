<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
    * Wakil direktur memverifikasi penilaian.
    *
    * @param \App\Models\Periode $periode
    * @return \Illuminate\Http\Response
    */
    public function wadir(Periode $periode)
    {
        // Jika belum diverifikasi kabag/kabid
        if (!$periode->verif_kabag) {
            return back()
                ->with('danger', 'Belum di verifikasi Kabag/Kabid');
        }

        $periode->verifWadir();

        return back()
            ->with('success', 'Berhasil di verifikasi');
    }

    /**
    * Kepala bagian memverifikasi penilaian.
    *
    * @param \App\Models\Periode $periode
    * @return \Illuminate\Http\Response
    */
    public function kabag(Periode $periode)
    {
        $periode->verifKabag();

        return back()
            ->with('success', 'Berhasil di verifikasi');
    }
}
