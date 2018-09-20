<?php

namespace App\Http\Requests;

use App\Models\Pegawai;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Unit;
use App\Models\Formasi;
use App\Models\Bagian;
use Illuminate\Validation\Rule;

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
            'nbm'           => 'nullable|integer|unique:pegawai|digits:6',
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
            $rules['nbm'] = ['nullable', 'integer', 'digits:6', Rule::unique('pegawai')->ignore($this->route('pegawai'))];
        }
        return $rules;
    }

    /**
     * Save record to the database
     *
     * @var string
     */
    public function save()
    {
        $pegawai = Pegawai::create($this->only(
            'nik','nbm','nama','jenis_kelamin','tempat_lahir',
            'tanggal_lahir','alamat','no_hp','tanggal_masuk'
        ));

        $unit    = Unit::findOrFail($this->unit);
        $formasi = Formasi::findOrFail($this->formasi);
        $bagian  = Bagian::findOrFail($this->bagian);

        $pegawai->unit()->associate($unit);
        $pegawai->formasi()->associate($formasi);
        $pegawai->bagian()->associate($bagian);
        $pegawai->save();

        return $pegawai;
    }

    public function update(Pegawai $pegawai)
    {
        $unit    = Unit::findOrFail($this->unit);
        $formasi = Formasi::findOrFail($this->formasi);
        $bagian  = Bagian::findOrFail($this->bagian);

        $pegawai->unit()->associate($unit);
        $pegawai->formasi()->associate($formasi);
        $pegawai->bagian()->associate($bagian);
        $pegawai->update($this->only(
            'nik','nbm','nama','jenis_kelamin','tempat_lahir',
            'tanggal_lahir','alamat','no_hp','tanggal_masuk'
        ));

        return $pegawai;
    }
    
}
