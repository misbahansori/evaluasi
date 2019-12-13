<?php

namespace App\Domain\Pegawai\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Domain\Master\Models\Unit;
use App\Domain\Master\Models\Bagian;
use App\Domain\Master\Models\Status;
use App\Domain\Master\Models\Formasi;
use App\Domain\Pegawai\Models\Pegawai;


class PegawaiViewModel extends ViewModel
{
    public function __construct(Pegawai $pegawai = null)
    {
        $this->pegawai = $pegawai;
    }

    /**
     * pegawai
     *
     * @return \App\Domain\Pegawai\Models\Pegawai
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
