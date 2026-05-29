<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterFormSetting extends Model
{
    protected $table = 'register_form_settings';

    protected $fillable = [
        'form_title',
        'form_highlight',
        'button_text',
        'success_message',
        'whatsapp_notice',
        'privacy_notice',
        'form_image',
        'label_child_name',
        'placeholder_child_name',
        'label_parent_name',
        'placeholder_parent_name',
        'label_age',
        'placeholder_age',
        'label_class',
        'placeholder_class',
        'label_program',
        'placeholder_program',
        'label_whatsapp',
        'placeholder_whatsapp',
        'label_note',
        'placeholder_note',
        'trust_text_1',
        'trust_text_2',
    ];

    // ----------------
    // HELPERS
    // ----------------

    /**
     * Ambil satu-satunya record form setting (singleton pattern).
     * Jika belum ada, buat dengan default.
     */
    public static function firstOrCreate(): static
    {
        return static::first() ?? static::create([
            'button_text' => 'Daftar Sekarang',
        ]);
    }
}
