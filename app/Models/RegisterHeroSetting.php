<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegisterHeroSetting extends Model
{
    protected $table = 'register_hero_settings';

    protected $fillable = [
        'badge_text',
        'title_line_1',
        'title_line_2',
        'title_highlight',
        'description',
        'benefit_1_title',
        'benefit_1_description',
        'benefit_2_title',
        'benefit_2_description',
        'benefit_3_title',
        'benefit_3_description',
        'counter_text',
        'counter_description',
    ];

    // ----------------
    // RELATIONSHIPS
    // ----------------

    /** Satu hero punya banyak benefit (checklist) */
    public function benefits(): HasMany
    {
        return $this->hasMany(RegisterBenefit::class, 'register_hero_id')
                    ->orderBy('sort_order');
    }

    // ----------------
    // HELPERS
    // ----------------

    /**
     * Ambil satu-satunya record hero setting (singleton pattern).
     * Jika belum ada, buat record kosong otomatis.
     */
    public static function firstOrCreate(): static
    {
        return static::first() ?? static::create([]);
    }
}
