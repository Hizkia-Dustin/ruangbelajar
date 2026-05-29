<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutProblemSolutionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'       => 'required|in:problem,solution',
            'text'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'Teks item wajib diisi.',
            'type.in'       => 'Tipe item harus problem atau solution.',
        ];
    }
}
