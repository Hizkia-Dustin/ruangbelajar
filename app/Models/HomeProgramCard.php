<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HomeProgramCard extends Model
{
    protected $fillable = [
        'title',
        'badge',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Accessor to get auto/random education themed icon based on ID */
    public function getDisplayIconAttribute(): string
    {
        $icons = [
            'fas fa-shapes',
            'fas fa-graduation-cap',
            'fas fa-book',
            'fas fa-pencil-alt',
            'fas fa-school',
            'fas fa-child',
            'fas fa-puzzle-piece',
            'fas fa-brain',
            'fas fa-lightbulb',
            'fas fa-chalkboard-user',
        ];

        return $icons[$this->id % count($icons)];
    }

    /** Scope: only active cards, ordered by sort_order */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
