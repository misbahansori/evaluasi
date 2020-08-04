<?php

namespace App\Http\Controllers;

use App\Domain\Penilaian\Models\Periode;


class VerifikasiController extends Controller
{
    /**
    * Wakil direktur memverifikasi penilaian.
    *
    * @param \App\Domain\Penilaian\Models\Periode $periode
    * @return \Illuminate\Http\Response
    */
    public function wadir(Periode $periode)
    {
        // Jika belum diverifikasi kabag/kabid
        if (!$periode->verif_kabag) {
            return back()
                ->with('danger', 'Belum di verifikasi Kabag/Kabid');
        }

        $this->authorize('verif wadir');

        $periode->verifWadir();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => $periode->pegawai->nama . ' berhasil diverifikasi'
            ]);
        }

        return back()
            ->with('success', 'Berhasil di verifikasi');
    }

    /**
    * Kepala bagian memverifikasi penilaian.
    *
    * @param \App\Domain\Penilaian\Models\Periode $periode
    * @return \Illuminate\Http\Response
    */
    public function kabag(Periode $periode)
    {
        $this->authorize('verif kabag');

        $periode->verifKabag();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => $periode->pegawai->nama . ' berhasil diverifikasi'
            ]);
        }
        
        return back()
            ->with('success', 'Berhasil di verifikasi');
    }

    /**
    * Direktur memverifikasi penilaian.
    *
    * @param \App\Domain\Penilaian\Models\Periode $periode
    * @return \Illuminate\Http\Response
    */
    public function direktur(Periode $periode)
    {
        $this->authorize('verif direktur');

        $periode->verifDirektur();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => $periode->pegawai->nama . ' berhasil diverifikasi'
            ]);
        }
        
        return back()
            ->with('success', 'Berhasil di verifikasi');
    }
}
