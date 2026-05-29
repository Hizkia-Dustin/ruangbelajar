<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Keunggulan extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'urutan',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Hapus global scope lama agar query lebih fleksibel dari controller
    // Controller yang menentukan sorting & filter

    /** Accessor untuk mendapatkan icon otomatis jika icon di DB kosong/null */
    public function getDisplayIconAttribute()
    {
        if (!empty($this->icon)) {
            return $this->icon;
        }

        $icons = [
            'fa-solid fa-book-open',
            'fa-solid fa-graduation-cap',
            'fa-solid fa-lightbulb',
            'fa-solid fa-brain',
            'fa-solid fa-medal',
            'fa-solid fa-user-graduate',
            'fa-solid fa-pencil',
            'fa-solid fa-star',
            'fa-solid fa-chalkboard-user',
            'fa-solid fa-hand-holding-heart',
        ];

        return $icons[$this->id % count($icons)];
    }

    /** Scope: hanya yang aktif, diurutkan by sort_order */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
