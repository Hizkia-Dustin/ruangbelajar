<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutProblemSolutionSetting extends Model
{
    protected $table = 'about_problem_solution_settings';

    protected $fillable = [
        'small_label',
        'main_title',
        'main_title_highlight',
        'problem_title',
        'solution_title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Singleton instance.
     */
    public static function getInstance(): static
    {
        return static::first() ?? static::create([
            'small_label'          => 'Problem vs Solution',
            'main_title'           => 'Pendekatan',
            'main_title_highlight' => 'Berbeda.',
            'problem_title'        => 'Kekhawatiran Umum.',
            'solution_title'       => 'Solusi Kami.',
            'is_active'            => true,
        ]);
    }
}
