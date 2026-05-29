<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Registration extends Model
{
    protected $table = 'registrations';

    protected $fillable = [
        'student_name', 'age', 'class_name', 'school',
        'parent_name', 'whatsapp', 'email',
        'program_id', 'program_name', 'selected_program',
        'notes', 'status', 'source',
        'contacted_at', 'admin_notes',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
    ];

    public const STATUSES = [
        'need_contact' => 'Perlu Dihubungi',
        'contacted'    => 'Sudah Dihubungi',
        'rejected'     => 'Tidak Lanjut',
    ];

    public const STATUS_COLORS = [
        'need_contact' => 'warning',
        'contacted'    => 'success',
        'rejected'     => 'danger',
    ];

    /** Tailwind badge classes per status */
    public const STATUS_BADGES = [
        'need_contact' => 'bg-amber-100 text-amber-700 border-amber-200',
        'contacted'    => 'bg-emerald-100 text-emerald-700 border-emerald-200',
        'rejected'     => 'bg-red-100 text-red-700 border-red-200',
    ];

    // ---- Accessors ----

    /** Nama tampil: student_name */
    public function getDisplayNameAttribute(): string
    {
        return $this->student_name;
    }

    /** Nomor HP: whatsapp */
    public function getDisplayPhoneAttribute(): string
    {
        return $this->whatsapp;
    }

    /** Program tampil: relasi program → text fallback */
    public function getDisplayProgramAttribute(): string
    {
        return $this->program?->title ?? $this->program_name ?? $this->selected_program ?? '–';
    }

    /** Label status */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /** Badge classes */
    public function getStatusBadgeAttribute(): string
    {
        return self::STATUS_BADGES[$this->status] ?? 'bg-gray-100 text-gray-600';
    }

    // ---- Relationships ----

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // ---- Scopes ----

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('student_name', 'like', "%{$keyword}%")
              ->orWhere('parent_name', 'like', "%{$keyword}%")
              ->orWhere('whatsapp', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }
}
