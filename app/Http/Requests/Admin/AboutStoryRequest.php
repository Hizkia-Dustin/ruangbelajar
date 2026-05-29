<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'story_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'story_title_line_1'     => 'required|string|max:255',
            'story_title_highlight'  => 'required|string|max:255',
            'story_description'      => 'required|string',
            'story_quote'            => 'required|string',
            'story_bottom_text'      => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'story_title_line_1.required'    => 'Judul baris 1 wajib diisi.',
            'story_title_highlight.required' => 'Judul highlight wajib diisi.',
            'story_description.required'     => 'Deskripsi cerita wajib diisi.',
            'story_quote.required'           => 'Quote cerita wajib diisi.',
            'story_bottom_text.required'     => 'Paragraf tambahan cerita wajib diisi.',
            'story_image.image'              => 'File harus berupa gambar.',
            'story_image.mimes'              => 'Format gambar harus jpg, jpeg, png, atau webp.',
        ];
    }
}
