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
            'nbm'           => 'nullable|string|digits:7',
            'nama'          => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date_format:d-m-Y',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'tanggal_masuk' => 'required|date_format:d-m-Y',
            'unit_id'       => 'required|integer|exists:roles,id',
            'formasi_id'    => 'required|integer|exists:formasi,id',
            'bagian_id'     => 'required|integer|exists:bagian,id',
            'status_id'     => 'required|integer|exists:status,id',
        ];

        if ($this->isMethod('put')) {
            $rules['nik'] = ['nullable', 'integer', 'digits:16', Rule::unique('pegawai')->ignore($this->route('pegawai'))];
        }

        return $rules;
    }
}
