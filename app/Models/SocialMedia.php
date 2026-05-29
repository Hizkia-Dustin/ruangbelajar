<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = ['platform', 'username', 'url', 'icon', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    /** Platform presets untuk icon otomatis */
    public const PLATFORMS = [
        'Instagram' => ['icon' => 'fab fa-instagram',  'color' => '#E1306C'],
        'WhatsApp'  => ['icon' => 'fab fa-whatsapp',   'color' => '#25D366'],
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /** Icon otomatis dari platform jika tidak di-set manual */
    public function getAutoIconAttribute(): string
    {
        return $this->icon ?: (self::PLATFORMS[$this->platform]['icon'] ?? 'fas fa-link');
    }
}
