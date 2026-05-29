<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSolutionSetting extends Model
{
    protected $table = 'home_solution_settings';

    protected $fillable = [
        'small_label',
        'title_line_1',
        'title_highlight',
        'title_line_2',
        'title_yellow',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Ambil satu-satunya record (singleton).
     * Jika belum ada, buat record default kosong.
     */
    public static function getInstance(): static
    {
        return static::first() ?? static::create([
            'small_label'     => 'THE SOLUTION',
            'title_line_1'    => 'Ubah',
            'title_highlight' => 'Kebingungan',
            'title_line_2'    => 'Menjadi',
            'title_yellow'    => 'Kepercayaan Diri.',
            'description'     => 'Banyak siswa terjebak dalam metode hafalan yang membosankan. Ruang Belajar hadir membongkar metode konvensional tersebut dengan cara yang jauh lebih interaktif dan bermakna.',
            'image'           => null,
            'is_active'       => true,
        ]);
    }
}
