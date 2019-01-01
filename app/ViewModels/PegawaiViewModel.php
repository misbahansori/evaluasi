<?php

namespace App\ViewModels;

use App\Models\Unit;
use App\Models\Bagian;
use App\Models\Status;
use App\Models\Formasi;
use App\Models\Pegawai;
use Spatie\ViewModels\ViewModel;

class PegawaiViewModel extends ViewModel
{
    public function __construct(Pegawai $pegawai = null)
    {
        $this->pegawai = $pegawai;
    }

    /**
     * pegawai
     *
     * @return \App\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->pegawai ?? new Pegawai;
    }
    
    /**
     * listUnit
     *
     * @return \Illuminate\Support\Collection
     */
    public function listUnit()
    {
        return Unit::orderBy('name')->get();
    }

    /**
     * listFormasi
     *
     * @return \Illuminate\Support\Collection
     */
    public function listFormasi()
    {
        return Formasi::orderBy('nama')->get();
    }

    /**
     * listBagian
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listBagian()
    {
        return Bagian::orderBy('nama')->get();
    }

    /**
     * listStatus
     *
     * @return \Illuminate\Support\Collection
     */
    public function listStatus()
    {
        return Status::all();
    }
}
