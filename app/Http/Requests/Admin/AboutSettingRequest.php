<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutSettingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'badge_text'          => 'nullable|string|max:150',
            'title'               => 'required|string|max:255',
            'highlighted_title'   => 'required|string|max:255',
            'description'         => 'required|string',
            'hero_image'          => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'vision_title'        => 'required|string|max:255',
            'vision_description'  => 'required|string',
            'mission_title'       => 'required|string|max:255',
            'mission_description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'               => 'Judul hero wajib diisi.',
            'highlighted_title.required'   => 'Judul highlight wajib diisi.',
            'description.required'         => 'Deskripsi hero wajib diisi.',
            'vision_title.required'        => 'Judul visi wajib diisi.',
            'vision_description.required'  => 'Deskripsi visi wajib diisi.',
            'mission_title.required'       => 'Judul misi wajib diisi.',
            'mission_description.required' => 'Deskripsi misi wajib diisi.',
            'hero_image.image'             => 'File harus berupa gambar.',
            'hero_image.mimes'             => 'Format gambar harus jpg, jpeg, png, atau webp.',
        ];
    }
}
