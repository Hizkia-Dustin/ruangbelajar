<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'testimonial',
        'photo',
        'tampil_di_beranda',
        'tampil_di_tentang',
        'is_featured',
        'is_active',
        'sort_order',
        'rating',
        'program_id',
    ];

    protected $casts = [
        'is_active'         => 'boolean',
        'is_featured'       => 'boolean',
        'tampil_di_beranda' => 'boolean',
        'tampil_di_tentang' => 'boolean',
        'rating'            => 'integer',
        'sort_order'        => 'integer',
        'program_id'        => 'integer',
    ];

    // ----------------
    // RELATIONSHIPS
    // ----------------

    /** Testimoni bisa terkait dengan program tertentu (opsional/nullable) */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // ----------------
    // LOCAL SCOPES
    // ----------------

    /** Filter testimoni aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Filter testimoni featured */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /** Tampilkan hanya testimoni untuk halaman beranda (legacy compatibility) */
    public function scopeBeranda($query)
    {
        return $query->where('tampil_di_beranda', true)->where('is_active', true)->orderBy('sort_order');
    }

    /** Tampilkan hanya testimoni untuk halaman tentang kami (legacy compatibility) */
    public function scopeAbout($query)
    {
        return $query->where('tampil_di_tentang', true)->where('is_active', true)->orderBy('sort_order');
    }

    /** Tampilkan testimoni untuk halaman program (legacy compatibility) */
    public function scopeForProgram($query, ?int $programId = null)
    {
        $q = $query->where('is_active', true);
        if ($programId) {
            $q->where('program_id', $programId);
        }
        return $q->orderBy('sort_order');
    }
}
