<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KeunggulanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Judul keunggulan wajib diisi.',
            'description.required' => 'Deskripsi keunggulan wajib diisi.',
        ];
    }
}
