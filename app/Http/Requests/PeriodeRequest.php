<?php

namespace App\Http\Requests;

use App\Models\Bulan;
use App\Models\Periode;
use Illuminate\Foundation\Http\FormRequest;

class PeriodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bulan' => 'required|integer',
            'tahun' => 'required|integer|digits:4'
        ];
    }

    public function persist()
    {
        $periode = $this->pegawai->periode()->create([
            'bulan_id' => $this->bulan,
            'tahun' => $this->tahun
        ]);

        $this->pegawai->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create([
                'aspek' => $item->nama, 
                'kategori' => $item->kategori
            ]);
        });
    }

    /**
     * Mengecek Pegawai punya Bagian
     *
     * @return void
     */
    public function cekPegawaiMempunyaiBagian()
    {
        if (!$this->pegawai->bagian) {
            return back()
                ->with('danger', 'Pegawai tidak memiliki bagian');
        }

        return $this;
    }

    /**
     * Mengecek Periode Table unique kolom pegawai_id, bulan_id, tahun
     *
     * @return \App\Models\Bulan $bulan
     */
    public function cekPeriodeUnique()
    {
        $bulan = Bulan::find($this->bulan);
    
        if (Periode::unique($this->pegawai->id, $bulan->id, $this->tahun)->exists()) {
            return back()
                ->with('danger', "Periode $bulan->nama $this->tahun sudah ada.");
        }

        return $bulan;
    }
}
