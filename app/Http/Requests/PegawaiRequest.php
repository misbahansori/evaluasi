<?php

namespace App\Http\Requests;

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
            'nik'           => 'nullable|string|unique:pegawai|digits:16',
            'nbm'           => 'nullable|string',
            'nama'          => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date_format:d-m-Y',
            'alamat'        => 'required|string',
            'no_hp'         => 'nullable|string|max:30',
            'tanggal_masuk' => 'required|date_format:d-m-Y',
            'unit_id'       => 'required|integer|exists:roles,id',
            'formasi_id'    => 'required|integer|exists:formasi,id',
            'bagian_id'     => 'required|integer|exists:bagian,id',
            'status_id'     => 'required|integer|exists:status,id',
            'komite_id'     => 'nullable|sometimes|exists:komite,id'
        ];

        if ($this->isMethod('put')) {
            $rules['nik'] = ['nullable', 'digits:16', Rule::unique('pegawai')->ignore($this->pegawai->id)];
        }

        return $rules;
    }
}
