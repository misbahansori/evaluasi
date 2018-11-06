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

}
