<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
        $rules = [
            'category' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sell_price' => 'required',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'image' => 'nullable',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'stock' => 'nullable',
            ];
        } else {
            $rules += [
                'image' => 'nullable',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'stock' => 'required',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari 2MB',
        ];
    }

    public function attributes()
    {
        return [
            'category' => 'Kategori',
            'name' => 'Nama produk',
            'price' => 'Harga Beli',
            'sell_price' => 'Harga Jual',
            'image' => 'Foto',
            'stock' => 'Stok',
        ];
    }
}
