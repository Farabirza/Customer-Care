<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeluhanPelangganRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|max:50',
            'email' => 'required|email|max:100',
            'nomor_hp' => 'required|digits_between:10,13',
            'keluhan' => 'required|min:50|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Masukan nama pelanggan',
            'nama.max' => 'Maksimal berisi 50 karakter',
            'email.required' => 'Masukan email pelanggan',
            'email.email' => 'Format email kurang sesuai',
            'email.max' => 'Maksimal berisi 100 karakter',
            'nomor_hp.required' => 'Masukan nomor kontak pelanggan',
            'nomor_hp.digits_between' => 'Hanya dapat memasukan 10 sampai 13 angka',
            'nomor_hp.max' => 'Maksimal berisi 15 karakter',
            'keluhan.required' => 'Paparkan keluhan pelanggan',
            'keluhan.min' => 'Minimal berisi 50 karakter',
            'keluhan.max' => 'Maksimal berisi 255 karakter',
        ];
    }
}
