<?php

namespace App\Http\Requests;

use App\Models\Unit;
use App\Models\Bagian;
use App\Models\Formasi;
use App\Models\Pegawai;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
        $rules = [
            'nik'           => 'nullable|integer|unique:pegawai|digits:16',
            'nbm'           => 'nullable|integer|unique:pegawai|digits:7',
            'nama'          => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date_format:d-m-Y',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'tanggal_masuk' => 'required|date_format:d-m-Y',
            'unit'          => 'required|integer|exists:unit,id',
            'formasi'       => 'required|integer|exists:formasi,id',
            'bagian'        => 'required|integer|exists:bagian,id',
        ];

        if ($this->isMethod('put')) {
            $rules['nik'] = ['nullable', 'integer', 'digits:16', Rule::unique('pegawai')->ignore($this->route('pegawai'))];
            $rules['nbm'] = ['nullable', 'integer', 'digits:7', Rule::unique('pegawai')->ignore($this->route('pegawai'))];
        }

        return $rules;
    }

    /**
     * Save record to the database
     *
     * @return App\Models\Pegawai $pegawai
     */
    public function save()
    {
        $pegawai = Pegawai::create($this->except('unit', 'formasi', 'bagian'));
        $this->associate($pegawai);
        $pegawai->save();

        return $pegawai;
    }

    /**
     * Update the given Pegawai
     * 
     * @param App\Models\Pegawai $pegawai
     * @return App\Models\Pegawai $pegawai
     */
    public function update(Pegawai $pegawai)
    {
        $this->associate($pegawai);
        $pegawai->update($this->except('unit', 'formasi', 'bagian'));

        return $pegawai;
    }

    /**
     * Associate model with Pegawai
     * 
     * @param App\Models\Pegawai $pegawai
     * @return App\Models\Pegawai $pegawai
     */
    public function associate(Pegawai $pegawai)
    {
        $unit    = Unit::findOrFail($this->unit);
        $formasi = Formasi::findOrFail($this->formasi);
        $bagian  = Bagian::findOrFail($this->bagian);

        $pegawai->unit()->associate($unit);
        $pegawai->formasi()->associate($formasi);
        $pegawai->bagian()->associate($bagian);

        return $pegawai;
    }
    
}
