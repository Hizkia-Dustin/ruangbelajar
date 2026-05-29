<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSetting;
use App\Models\AboutProblemSolutionSetting;
use App\Models\AboutProblemSolutionItem;
use App\Models\AboutStatistic;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed/Update Kisah Kami di AboutSetting
        AboutSetting::updateOrCreate(
            ['id' => 1],
            [
                'story_title_line_1'     => 'Kisah Kami Berawal Dari',
                'story_title_highlight'  => 'Satu Misi.',
                'story_description'      => 'Didirikan dengan kepedulian mendalam terhadap potensi unik setiap anak, Ruang Belajar hadir untuk meruntuhkan batasan metode belajar konvensional yang membosankan.',
                'story_quote'            => 'Setiap anak adalah bintang yang berhak mendapatkan cara belajar yang paling sesuai dengan dirinya.',
                'story_bottom_text'      => 'Kami percaya bahwa pendidikan bukan hanya tentang angka di rapor, tapi tentang menumbuhkan rasa ingin tahu dan kepercayaan diri sepanjang hayat.',
            ]
        );

        // 2. Seed/Update Problem vs Solution Setting
        AboutProblemSolutionSetting::updateOrCreate(
            ['id' => 1],
            [
                'small_label'          => 'Problem vs Solution',
                'main_title'           => 'Pendekatan',
                'main_title_highlight' => 'Berbeda.',
                'problem_title'        => 'Kekhawatiran Umum.',
                'solution_title'       => 'Solusi Kami.',
                'is_active'            => true,
            ]
        );

        // 3. Seed/Update Problem Items
        $problems = [
            ['id' => 1, 'type' => 'problem', 'text' => 'Anak sering merasa tertekan dengan materi sekolah yang terlalu padat.', 'sort_order' => 1, 'is_active' => true],
            ['id' => 2, 'type' => 'problem', 'text' => 'Metode hafalan yang membuat anak cepat lupa dan tidak memahami konsep.', 'sort_order' => 2, 'is_active' => true],
            ['id' => 3, 'type' => 'problem', 'text' => 'Kurangnya perhatian personal karena jumlah siswa di kelas terlalu banyak.', 'sort_order' => 3, 'is_active' => true],
        ];

        foreach ($problems as $item) {
            AboutProblemSolutionItem::updateOrCreate(
                ['id' => $item['id']],
                [
                    'type'       => $item['type'],
                    'text'       => $item['text'],
                    'sort_order' => $item['sort_order'],
                    'is_active'  => $item['is_active'],
                ]
            );
        }

        // 4. Seed/Update Solution Items
        $solutions = [
            ['id' => 4, 'type' => 'solution', 'text' => 'Belajar santai dengan sistem "Personalized Speed" yang tidak membebani.', 'sort_order' => 1, 'is_active' => true],
            ['id' => 5, 'type' => 'solution', 'text' => 'Fokus pada "Logic & Reasoning", bukan sekadar menyimpan hafalan teks.', 'sort_order' => 2, 'is_active' => true],
            ['id' => 6, 'type' => 'solution', 'text' => 'Kelas kecil yang memastikan setiap anak mendapatkan perhatian intensif dari tutor.', 'sort_order' => 3, 'is_active' => true],
        ];

        foreach ($solutions as $item) {
            AboutProblemSolutionItem::updateOrCreate(
                ['id' => $item['id']],
                [
                    'type'       => $item['type'],
                    'text'       => $item['text'],
                    'sort_order' => $item['sort_order'],
                    'is_active'  => $item['is_active'],
                ]
            );
        }

        // 5. Seed/Update Statistics
        $statistics = [
            ['id' => 1, 'number' => '100+', 'label' => 'Siswa Aktif', 'sort_order' => 1, 'is_active' => true],
            ['id' => 2, 'number' => '15+',  'label' => 'Tutor Profesional', 'sort_order' => 2, 'is_active' => true],
            ['id' => 3, 'number' => '98%',  'label' => 'Tingkat Prestasi', 'sort_order' => 3, 'is_active' => true],
        ];

        foreach ($statistics as $item) {
            AboutStatistic::updateOrCreate(
                ['id' => $item['id']],
                [
                    'number'     => $item['number'],
                    'label'      => $item['label'],
                    'sort_order' => $item['sort_order'],
                    'is_active'  => $item['is_active'],
                ]
            );
        }

        $this->command->info('✅ AboutPageSeeder berhasil dijalankan!');
    }
}
