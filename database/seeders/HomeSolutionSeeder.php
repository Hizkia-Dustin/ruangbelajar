<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSolutionSetting;
use App\Models\HomeSolutionPoint;

class HomeSolutionSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder idempotent untuk home_solution_settings
        HomeSolutionSetting::updateOrCreate(
            ['id' => 1],
            [
                'small_label'     => 'THE SOLUTION',
                'title_line_1'    => 'Ubah',
                'title_highlight' => 'Kebingungan',
                'title_line_2'    => 'Menjadi',
                'title_yellow'    => 'Kepercayaan Diri.',
                'description'     => 'Banyak siswa terjebak dalam metode hafalan yang membosankan. Ruang Belajar hadir membongkar metode konvensional tersebut dengan cara yang jauh lebih interaktif dan bermakna.',
                'is_active'       => true,
            ]
        );

        // Seeder idempotent untuk home_solution_points
        $points = [
            ['id' => 1, 'title' => 'Tutor asyik & sabar', 'sort_order' => 1, 'is_active' => true],
            ['id' => 2, 'title' => 'Materi per jenjang',   'sort_order' => 2, 'is_active' => true],
            ['id' => 3, 'title' => 'Kuis interaktif',    'sort_order' => 3, 'is_active' => true],
            ['id' => 4, 'title' => 'Progress report',    'sort_order' => 4, 'is_active' => true],
        ];

        foreach ($points as $point) {
            HomeSolutionPoint::updateOrCreate(
                ['id' => $point['id']],
                [
                    'title'      => $point['title'],
                    'sort_order' => $point['sort_order'],
                    'is_active'  => $point['is_active'],
                ]
            );
        }

        $this->command->info('✅ HomeSolutionSeeder berhasil dijalankan!');
    }
}
