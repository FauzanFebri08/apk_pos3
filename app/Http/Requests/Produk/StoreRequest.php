<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0'
        ];
    }
    public function messages(): array
    {
    return [
        'foto.image'     => 'file yang di upload harus ada gambar',
        'foto.mimes'     => 'existensi gambar harus JPG,JPEG,PNG',
        'foto.max'       => 'maksimal ukuran gambar 2mb',
        'name.required'  => 'Nama Wajib diisi.',
        'email.email'    => 'Format email tidak valid.',
        'purchase_price.integer'  => 'purchase price harus diisi bilangan bulat.',
        'purchase_price.required' => 'harga beli wajib diisi.',
        'selling_price.required'  => 'harga jual wajib diisi.',
        'selling_price.integer'   => 'selling price harus diisi bilangan bulat.',
        'stok.required'          => 'Stock wajib diisi.',
        'stok.integer'           => 'Stock harus diisi angka.',
    ];
}
}
