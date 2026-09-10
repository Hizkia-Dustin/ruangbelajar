<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSetting;
use App\Models\AboutApproach;

class AboutSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutSetting::updateOrCreate(['id' => 1], [
            'badge_text'          => 'Legacy & Vision',
            'title'               => 'Membangun Masa Depan',
            'highlighted_title'   => 'Bersama Kami.',
            'description'         => 'Kisah perjalanan kami dalam menghadirkan solusi pendidikan yang asik, cerdas, dan bermakna bagi setiap anak.',
            'vision_title'        => 'Menjadi Rumah Inovasi.',
            'vision_description'  => 'Menjadi lembaga bimbingan belajar terdepan yang melahirkan generasi cerdas, mandiri, kreatif, dan memiliki daya saing tinggi dengan dasar karakter yang kuat.',
            'mission_title'       => 'Membangun Nilai Nyata.',
            'mission_description' => 'Memberikan pendampingan akademik terbaik secara profesional yang berfokus pada kedekatan personal dan pemahaman konsep yang mendalam guna mencetak siswa berprestasi.',
        ]);

        $approaches = [
            ['icon' => 'fas fa-fingerprint', 'title' => 'Pendekatan Personal',   'description' => 'Setiap anak mendapatkan perhatian eksklusif yang disesuaikan dengan kemampuan dan gaya belajarnya.',          'sort_order' => 1],
            ['icon' => 'fas fa-lightbulb',   'title' => 'Belajar Menyenangkan',  'description' => 'Materi disampaikan dengan cara yang interaktif, kreatif, dan menyenangkan agar mudah dipahami.',             'sort_order' => 2],
            ['icon' => 'fas fa-cubes',       'title' => 'Logika & Pemahaman',    'description' => 'Fokus melatih cara berpikir kritis dan logis, bukan sekadar hafalan yang cepat terlupakan.',                  'sort_order' => 3],
            ['icon' => 'fas fa-chart-line',  'title' => 'Progress Terukur',      'description' => 'Setiap perkembangan belajar dipantau dan dilaporkan secara berkala kepada orang tua.',                        'sort_order' => 4],
        ];

        foreach ($approaches as $data) {
            AboutApproach::updateOrCreate(['type' => 'approach', 'title' => $data['title']], array_merge($data, ['is_active' => true, 'text' => $data['title']]));
        }

        $this->command->info('✅ AboutSettingSeeder berhasil!');
    }
}
