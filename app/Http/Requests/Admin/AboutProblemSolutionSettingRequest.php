<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutProblemSolutionSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'small_label'          => 'required|string|max:150',
            'main_title'           => 'required|string|max:255',
            'main_title_highlight' => 'required|string|max:255',
            'problem_title'        => 'required|string|max:255',
            'solution_title'       => 'required|string|max:255',
            'is_active'            => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'small_label.required'          => 'Label kecil wajib diisi.',
            'main_title.required'           => 'Judul utama wajib diisi.',
            'main_title_highlight.required' => 'Judul highlight wajib diisi.',
            'problem_title.required'        => 'Judul problem wajib diisi.',
            'solution_title.required'       => 'Judul solusi wajib diisi.',
        ];
    }
}
