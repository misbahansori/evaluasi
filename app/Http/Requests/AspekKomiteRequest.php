<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AspekKomiteRequest extends FormRequest
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
            'komite_id' => 'required|integer|exists:komite,id',
            'nama'      => 'required|string|max:150',
            'kategori'  => 'required|max:150',
        ];
    }
}
