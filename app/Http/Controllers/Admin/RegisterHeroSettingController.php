<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterHeroSetting;
use App\Models\RegisterFormSetting;
use App\Models\RegisterBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * RegisterHeroSettingController: Mengelola hero section halaman pendaftaran.
 * Pola singleton (update saja, tidak create/delete untuk data utama).
 */
class RegisterHeroSettingController extends Controller
{
    public function index()
    {
        $hero = RegisterHeroSetting::first() ?? RegisterHeroSetting::create([
            'badge_text'            => '🎓 Pendaftaran Terbuka',
            'title_line_1'          => 'Mulai Perjalanan Belajar',
            'title_line_2'          => null,
            'title_highlight'       => 'Yang Menyenangkan',
            'description'           => 'Daftarkan putra-putri Anda sekarang dan rasakan pengalaman belajar yang berbeda. Kelas kecil, metode playful, dan pendampingan penuh.',
            'benefit_1_title'       => 'Kelas Super Kecil',
            'benefit_1_description' => 'Maksimal 5 anak per sesi untuk kenyamanan belajar.',
            'benefit_2_title'       => 'Metode Playful',
            'benefit_2_description' => 'Belajar asik tanpa tekanan melalui pendekatan personal.',
            'benefit_3_title'       => 'Konsultasi Gratis',
            'benefit_3_description' => 'Bantu pilihkan program terbaik untuk putra-putri Anda.',
            'counter_text'          => '100+ Anak',
            'counter_description'   => 'Telah Bergabung Bersama Kami',
        ]);

        $formSetting = RegisterFormSetting::firstOrCreate();

        return view('admin.register.hero', compact('hero', 'formSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Hero validation
            'badge_text'            => 'nullable|string|max:100',
            'title_line_1'          => 'nullable|string|max:255',
            'title_line_2'          => 'nullable|string|max:255',
            'title_highlight'       => 'nullable|string|max:255',
            'description'           => 'nullable|string',
            'benefit_1_title'       => 'nullable|string|max:255',
            'benefit_1_description' => 'nullable|string|max:500',
            'benefit_2_title'       => 'nullable|string|max:255',
            'benefit_2_description' => 'nullable|string|max:500',
            'benefit_3_title'       => 'nullable|string|max:255',
            'benefit_3_description' => 'nullable|string|max:500',
            'counter_text'          => 'nullable|string|max:100',
            'counter_description'   => 'nullable|string|max:255',

            // Form validation
            'form_title'              => 'nullable|string|max:255',
            'form_highlight'          => 'nullable|string|max:255',
            'label_child_name'        => 'nullable|string|max:255',
            'placeholder_child_name'  => 'nullable|string|max:255',
            'label_parent_name'       => 'nullable|string|max:255',
            'placeholder_parent_name' => 'nullable|string|max:255',
            'label_age'               => 'nullable|string|max:255',
            'placeholder_age'         => 'nullable|string|max:255',
            'label_class'             => 'nullable|string|max:255',
            'placeholder_class'       => 'nullable|string|max:255',
            'label_program'           => 'nullable|string|max:255',
            'placeholder_program'     => 'nullable|string|max:255',
            'label_whatsapp'          => 'nullable|string|max:255',
            'placeholder_whatsapp'    => 'nullable|string|max:255',
            'label_note'              => 'nullable|string|max:255',
            'placeholder_note'        => 'nullable|string|max:255',
            'trust_text_1'            => 'nullable|string|max:255',
            'trust_text_2'            => 'nullable|string|max:255',
            'button_text'             => 'nullable|string|max:100',
        ]);

        // Simpan Hero Settings
        $hero = RegisterHeroSetting::first() ?? new RegisterHeroSetting();
        $heroData = $request->only([
            'badge_text', 'title_line_1', 'title_line_2', 'title_highlight', 'description',
            'benefit_1_title', 'benefit_1_description',
            'benefit_2_title', 'benefit_2_description',
            'benefit_3_title', 'benefit_3_description',
            'counter_text', 'counter_description'
        ]);
        $hero->fill($heroData)->save();

        // Simpan Form Settings
        $formSetting = RegisterFormSetting::firstOrCreate();
        $formData = $request->only([
            'form_title', 'form_highlight', 'button_text',
            'label_child_name', 'placeholder_child_name',
            'label_parent_name', 'placeholder_parent_name',
            'label_age', 'placeholder_age',
            'label_class', 'placeholder_class',
            'label_program', 'placeholder_program',
            'label_whatsapp', 'placeholder_whatsapp',
            'label_note', 'placeholder_note',
            'trust_text_1', 'trust_text_2',
        ]);
        $formSetting->fill($formData)->save();

        return redirect()->route('admin.register.hero.index')
            ->with('success', '✅ Pengaturan Halaman Daftar berhasil diperbarui!');
    }
}
