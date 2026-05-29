<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutStatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number'     => 'required|string|max:100',
            'label'      => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'number.required' => 'Angka statistik wajib diisi (contoh: 100+).',
            'label.required'  => 'Label statistik wajib diisi (contoh: Siswa Aktif).',
        ];
    }
}
