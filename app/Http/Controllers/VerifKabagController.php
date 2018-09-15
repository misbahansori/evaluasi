<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class VerifKabagController extends Controller
{
    /**
    * store relationship
    */
    public function store(Periode $periode)
    {
       $periode->verifKabag();

       return redirect()->back()->with('success', 'Berhasil di verifikasi');
    }
}
