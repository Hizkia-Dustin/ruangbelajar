<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $table = 'about_settings';

    protected $fillable = [
        'badge_text',
        'title',
        'highlighted_title',
        'description',
        'hero_image',
        'vision_title',
        'vision_description',
        'mission_title',
        'mission_description',
        'story_image',
        'story_title_line_1',
        'story_title_highlight',
        'story_description',
        'story_quote',
        'story_bottom_text',
    ];

    /**
     * Ambil satu-satunya record (singleton).
     * Jika belum ada, buat record default.
     */
    public static function getInstance(): static
    {
        return static::first() ?? static::create([
            'badge_text'          => 'Legacy & Vision',
            'title'               => 'Membangun Masa Depan',
            'highlighted_title'   => 'Bersama Kami.',
            'description'         => 'Kisah perjalanan kami dalam menghadirkan solusi pendidikan yang asik, cerdas, dan bermakna bagi setiap anak.',
            'vision_title'        => 'Menjadi Rumah Inovasi.',
            'vision_description'  => 'Menjadi lembaga bimbingan belajar terdepan yang melahirkan generasi cerdas, mandiri, kreatif, dan memiliki daya saing tinggi dengan dasar karakter yang kuat.',
            'mission_title'       => 'Membangun Nilai Nyata.',
            'mission_description' => 'Memberikan pendampingan akademik terbaik secara profesional yang berfokus pada kedekatan personal dan pemahaman konsep yang mendalam guna mencetak siswa berprestasi.',
        ]);
    }
}
