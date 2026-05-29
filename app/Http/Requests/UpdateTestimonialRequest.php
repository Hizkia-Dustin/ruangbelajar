<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'role'              => 'required|string|max:255',
            'testimonial'       => 'required|string',
            'rating'            => 'required|integer|min:1|max:5',
            'tampil_di_beranda' => 'boolean',
            'tampil_di_tentang' => 'boolean',
            'photo'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'sort_order'        => 'nullable|integer',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'Nama orang tua/wali wajib diisi.',
            'role.required'             => 'Role/status wajib diisi (contoh: Wali Murid TK).',
            'testimonial.required'      => 'Isi testimoni wajib diisi.',
            'rating.required'           => 'Rating bintang wajib dipilih.',
            'rating.integer'            => 'Rating harus berupa angka.',
            'rating.min'                => 'Rating minimal 1 bintang.',
            'rating.max'                => 'Rating maksimal 5 bintang.',
            'photo.image'               => 'Foto harus berupa file gambar.',
            'photo.mimes'               => 'Format foto harus berupa jpeg, jpg, png, atau webp.',
            'photo.max'                 => 'Ukuran foto maksimal 2MB.',
            'sort_order.integer'        => 'Urutan tampil harus berupa angka.',
        ];
    }
}
