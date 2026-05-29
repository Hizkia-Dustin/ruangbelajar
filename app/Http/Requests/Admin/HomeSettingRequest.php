<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HomeSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Hero
            'badge_text'        => 'nullable|string|max:150',
            'title'             => 'required|string|max:255',
            'highlighted_title' => 'required|string|max:255',
            'description'       => 'required|string',
            'button_text'       => 'required|string|max:100',
            'button_link'       => 'required|string|max:255',
            'hero_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'website_logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            // Statistik
            'total_students'    => 'required|integer|min:0',
            'total_programs'    => 'required|integer|min:0',
            'total_tutors'      => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'             => 'Judul utama wajib diisi.',
            'highlighted_title.required' => 'Judul highlight wajib diisi.',
            'description.required'       => 'Deskripsi wajib diisi.',
            'button_text.required'       => 'Teks tombol wajib diisi.',
            'button_link.required'       => 'Link tombol wajib diisi.',
            'total_students.required'    => 'Total siswa wajib diisi.',
            'total_programs.required'    => 'Total program wajib diisi.',
            'total_tutors.required'      => 'Total tutor wajib diisi.',
            'hero_image.image'           => 'File harus berupa gambar.',
            'hero_image.mimes'           => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'website_logo.image'         => 'File logo harus berupa gambar.',
            'website_logo.mimes'         => 'Format logo harus jpg, jpeg, png, atau webp.',
        ];
    }
}
