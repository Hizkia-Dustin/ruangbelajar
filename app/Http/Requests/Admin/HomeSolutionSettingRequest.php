<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HomeSolutionSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'small_label'     => 'required|string|max:150',
            'title_line_1'    => 'required|string|max:255',
            'title_highlight' => 'required|string|max:255',
            'title_line_2'    => 'required|string|max:255',
            'title_yellow'    => 'required|string|max:255',
            'description'     => 'required|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'is_active'       => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'small_label.required'     => 'Label kecil wajib diisi.',
            'title_line_1.required'    => 'Judul baris 1 wajib diisi.',
            'title_highlight.required' => 'Judul highlight wajib diisi.',
            'title_line_2.required'    => 'Judul baris 2 wajib diisi.',
            'title_yellow.required'    => 'Judul highlight kuning wajib diisi.',
            'description.required'     => 'Deskripsi wajib diisi.',
            'image.image'              => 'File harus berupa gambar.',
            'image.mimes'              => 'Format gambar harus jpg, jpeg, png, atau webp.',
        ];
    }
}
