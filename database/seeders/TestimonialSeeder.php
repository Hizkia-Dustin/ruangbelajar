<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing testimonials to avoid duplicates and clean old structure
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Testimonial::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $testimonials = [
            // Home (2 items)
            [
                'name'             => 'Ibu Maya',
                'role'             => 'Wali Murid - SD Tajur',
                'testimonial'      => 'Anak saya menjadi jauh lebih disiplin dalam belajar. Kenaikan nilai di sekolah terlihat sangat nyata hanya dalam 3 bulan.',
                'rating'           => 5,
                'photo'            => null,
                'display_location' => 'home',
                'is_featured'      => true,
                'is_active'        => true,
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Pak Rudi',
                'role'             => 'Wali Murid - TK Pakuan',
                'testimonial'      => 'Tutor di Ruang Belajar benar-benar tahu cara menghandle semangat anak yang sedang turun. Sangat personal dan sabar!',
                'rating'           => 5,
                'photo'            => null,
                'display_location' => 'home',
                'is_featured'      => false,
                'is_active'        => true,
                'sort_order'       => 2,
            ],

            // About (2 items)
            [
                'name'             => 'Ibu Ratna',
                'role'             => 'Wali Murid Kelas 4 SD',
                'testimonial'      => 'Pendekatan tutornya sangat sabar dan personal. Anak saya yang awalnya phobia matematika, kini jadi juara kelas!',
                'rating'           => 5,
                'photo'            => null,
                'display_location' => 'about',
                'is_featured'      => true,
                'is_active'        => true,
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Bapak Hendra',
                'role'             => 'Wali Murid TK A',
                'testimonial'      => 'Ruang Belajar benar-benar berbeda. Bukan sekadar les biasa, tapi membentuk karakter anak saya secara menyeluruh.',
                'rating'           => 5,
                'photo'            => null,
                'display_location' => 'about',
                'is_featured'      => false,
                'is_active'        => true,
                'sort_order'       => 2,
            ],

            // Both (2 items)
            [
                'name'             => 'Ibu Sari',
                'role'             => 'Wali Murid TK B',
                'testimonial'      => 'Ruang Belajar bukan sekadar tempat les biasa. Di sini, anak saya menemukan kembali semangat belajarnya!',
                'rating'           => 5,
                'photo'            => null,
                'display_location' => 'both',
                'is_featured'      => true,
                'is_active'        => true,
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Bunda Madha Kafka',
                'role'             => 'Orang Tua Siswa SD Kelas 3',
                'testimonial'      => 'Tutor sabar banget, anak saya yang tadinya ogah-ogahan belajar sekarang malah nagih masuk les terus!',
                'rating'           => 4,
                'photo'            => null,
                'display_location' => 'both',
                'is_featured'      => false,
                'is_active'        => true,
                'sort_order'       => 2,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}
