<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StaffRequest extends FormRequest
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
        $rules =  [
            'user' => 'required',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'required|min:8',
                'confirmation_password' => 'nullable',
                'new_password' => 'nullable',
                'current_password' => 'nullable'
            ];
        } else {
            $rules += [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'password' => 'nullable',
                'current_password' => 'min:8|nullable',
                'new_password' => 'min:8|same:confirmation_password|nullable',
                'confirmation_password' => 'min:8|same:new_password|nullable',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah digunakan',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'same' => ':attribute tidak sama dengan :other',
            'date' => ':attribute harus berupa tanggal',
            'numeric' => ':attribute harus berupa angka',
            'regex' => ':attribute panjang 12 karakter',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'gender' => 'Jenis kelamin',
            'phone' => 'No. telp',
            'address' => 'Alamat',
            'user' => 'Username',
            'password' => 'Password',
            'current_password' => 'Password sekarang',
            'new_password' => 'Password baru',
            'confirmation_password' => 'Password konfirmasi'
        ];
    }
}
