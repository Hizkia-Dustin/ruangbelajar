<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            // Hero Kontak
            ['key' => 'contact_hero_badge_text', 'value' => 'PELAYANAN SEPENUH HATI', 'group' => 'contact_hero'],
            ['key' => 'contact_hero_title_line_1', 'value' => 'Kami Siap', 'group' => 'contact_hero'],
            ['key' => 'contact_hero_title_highlight', 'value' => 'Mendengarkan.', 'group' => 'contact_hero'],
            ['key' => 'contact_hero_description', 'value' => 'Jangan biarkan kebingungan menghambat potensi anak Anda. Kami di sini untuk membimbing Anda memilih langkah terbaik.', 'group' => 'contact_hero'],
            ['key' => 'contact_hero_is_active', 'value' => '1', 'group' => 'contact_hero'],
            
            // FAQ & Konsultasi
            ['key' => 'contact_faq_badge', 'value' => 'Pertanyaan Umum', 'group' => 'contact_faq'],
            ['key' => 'contact_faq_title', 'value' => 'Mungkin Anda', 'group' => 'contact_faq'],
            ['key' => 'contact_faq_highlight', 'value' => 'Bertanya.', 'group' => 'contact_faq'],
            ['key' => 'contact_konsultasi_badge', 'value' => 'Respon Cepat', 'group' => 'contact_konsultasi'],
            ['key' => 'contact_konsultasi_title', 'value' => 'Konsultasi', 'group' => 'contact_konsultasi'],
            ['key' => 'contact_konsultasi_highlight', 'value' => 'Gratis', 'group' => 'contact_konsultasi'],
            ['key' => 'contact_konsultasi_button_text', 'value' => 'Chat WhatsApp Sekarang', 'group' => 'contact_konsultasi'],
            ['key' => 'contact_konsultasi_description', 'value' => 'Admin Standby 24/7', 'group' => 'contact_konsultasi'],
            ['key' => 'contact_whatsapp_number', 'value' => '6283157112597', 'group' => 'contact_cta'],
            
            // Informasi Kontak
            ['key' => 'contact_info_section_title', 'value' => 'Kunjungi', 'group' => 'contact_info'],
            ['key' => 'contact_info_section_highlight', 'value' => 'Rumah Belajar Kami.', 'group' => 'contact_info'],
            ['key' => 'contact_info_address_title', 'value' => 'Lokasi Strategis', 'group' => 'contact_info'],
            ['key' => 'contact_info_address_text', 'value' => 'Tajur, Bogor Selatan, Kota Bogor, Jawa Barat', 'group' => 'contact_info'],
            ['key' => 'contact_info_email_title', 'value' => 'Email Support', 'group' => 'contact_info'],
            ['key' => 'contact_info_email_text', 'value' => 'halo@ruangbelajar.com', 'group' => 'contact_info'],
            ['key' => 'contact_info_whatsapp_title', 'value' => 'WhatsApp Admin', 'group' => 'contact_info'],
            ['key' => 'contact_info_whatsapp_text', 'value' => '0831-5711-2597', 'group' => 'contact_info'],
            ['key' => 'contact_info_instagram_title', 'value' => 'Instagram Resmi', 'group' => 'contact_info'],
            ['key' => 'contact_info_instagram_text', 'value' => '@ruangbelajar.bogor', 'group' => 'contact_info'],
            ['key' => 'contact_info_operational_title', 'value' => 'Jam Operasional', 'group' => 'contact_info'],
            ['key' => 'contact_info_operational_text', 'value' => 'Senin–Sabtu, 08:00–18:00 WIB', 'group' => 'contact_info'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }

    public function down(): void
    {
        // No need to rollback to avoid data loss
    }
};
