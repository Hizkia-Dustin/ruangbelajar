<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'badge_text'       => 'nullable|string|max:100',
            'kategori'         => 'nullable|string|max:100',
            'age_range'        => 'nullable|string|max:100',
            'short_description'=> 'nullable|string|max:500',
            'description'      => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text'      => 'nullable|string|max:100',
            'button_link'      => 'nullable|string|max:255',
            'background_theme' => 'nullable|string|max:50',
            'sort_order'       => 'nullable|integer',
            'is_active'        => 'boolean',
            'is_featured'      => 'boolean',
            'status'           => 'nullable|in:active,draft,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Nama program wajib diisi.',
            'description.required' => 'Deskripsi program wajib diisi.',
            'thumbnail.image'      => 'File harus berupa gambar.',
            'thumbnail.mimes'      => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'thumbnail.max'        => 'Ukuran gambar maksimal 2MB.',
            'sort_order.integer'   => 'Urutan harus berupa angka.',
        ];
    }
}
