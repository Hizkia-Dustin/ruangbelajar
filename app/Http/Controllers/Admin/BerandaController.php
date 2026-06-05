<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSettingRequest;
use App\Http\Requests\Admin\KeunggulanRequest;
use App\Http\Requests\Admin\HomeSolutionSettingRequest;
use App\Http\Requests\Admin\HomeSolutionPointRequest;
use App\Models\HomeSetting;
use App\Models\Keunggulan;
use App\Models\HomeSolutionSetting;
use App\Models\HomeSolutionPoint;
use App\Models\HomeProgramCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * BerandaController: Mengelola halaman CMS Beranda dari admin panel.
 * - index()         → tampil halaman lengkap (hero + statistik + keunggulan + solusi)
 * - updateHero()    → update hero section + statistik
 * - storeKeunggulan()   → tambah keunggulan baru (tanpa icon input)
 * - updateKeunggulan()  → edit keunggulan (tanpa icon input)
 * - destroyKeunggulan() → hapus keunggulan
 * - toggleKeunggulan()  → aktif/nonaktif
 * - updateSolutionSetting() → update setelan solusi
 * - storeSolutionPoint()    → tambah poin solusi
 * - updateSolutionPoint()   → edit poin solusi
 * - destroySolutionPoint()  → hapus poin solusi
 * - toggleSolutionPoint()   → toggle status poin solusi
 */
class BerandaController extends Controller
{
    // ==========================================
    // MAIN PAGE
    // ==========================================

    public function index()
    {
        $setting         = HomeSetting::getInstance();
        $keunggulans     = Keunggulan::orderBy('sort_order')->orderBy('id')->get();
        $solutionSetting = HomeSolutionSetting::getInstance();
        $solutionPoints  = HomeSolutionPoint::orderBy('sort_order')->orderBy('id')->get();
        $programCards    = HomeProgramCard::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.beranda.index', compact('setting', 'keunggulans', 'solutionSetting', 'solutionPoints', 'programCards'));
    }

    // ==========================================
    // HERO + STATISTIK
    // ==========================================

    public function updateHero(HomeSettingRequest $request)
    {
        $setting = HomeSetting::getInstance();

        $data = $request->only([
            'badge_text', 'title', 'highlighted_title', 'description',
            'button_text', 'button_link',
            'total_students', 'total_programs', 'total_tutors',
        ]);

        // Handle upload gambar hero
        if ($request->hasFile('hero_image')) {
            // Hapus gambar lama dari storage
            if ($setting->hero_image && Storage::disk('public')->exists($setting->hero_image)) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')
                ->store('home', 'public');
        }

        // Handle upload logo website utama
        if ($request->hasFile('website_logo')) {
            \App\Models\Setting::upload('website_logo', $request->file('website_logo'), 'images/logo', 'website_setting');
        }

        $setting->update($data);

        return redirect()
            ->route('admin.beranda.index')
            ->with('success', '✅ Hero & Statistik berhasil diperbarui!');
    }

    // ==========================================
    // KEUNGGULAN CRUD
    // ==========================================

    public function storeKeunggulan(KeunggulanRequest $request)
    {
        // Auto sort_order: ambil nilai tertinggi + 1
        $maxOrder = Keunggulan::max('sort_order') ?? 0;

        Keunggulan::create([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $maxOrder + 1),
            'urutan'      => $request->input('sort_order', $maxOrder + 1),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '✅ Keunggulan berhasil ditambahkan!');
    }

    public function editKeunggulan(Keunggulan $keunggulan)
    {
        return view('admin.beranda.keunggulan-edit', compact('keunggulan'));
    }

    public function updateKeunggulan(KeunggulanRequest $request, Keunggulan $keunggulan)
    {
        $keunggulan->update([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $keunggulan->sort_order),
            'urutan'      => $request->input('sort_order', $keunggulan->sort_order),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '✅ Keunggulan berhasil diperbarui!');
    }

    public function destroyKeunggulan(Keunggulan $keunggulan)
    {
        $keunggulan->delete();

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '🗑️ Keunggulan berhasil dihapus!');
    }

    public function toggleKeunggulan(Keunggulan $keunggulan)
    {
        $keunggulan->update(['is_active' => !$keunggulan->is_active]);

        $status = $keunggulan->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "✅ Keunggulan \"{$keunggulan->title}\" berhasil {$status}!");
    }

    // ==========================================
    // SOLUTION SECTION CMS
    // ==========================================

    public function updateSolutionSetting(HomeSolutionSettingRequest $request)
    {
        $setting = HomeSolutionSetting::getInstance();

        $data = $request->only([
            'small_label', 'title_line_1', 'title_highlight',
            'title_line_2', 'title_yellow', 'description',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        // Handle upload gambar solution
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($setting->image && Storage::disk('public')->exists($setting->image)) {
                Storage::disk('public')->delete($setting->image);
            }
            $data['image'] = $request->file('image')
                ->store('home', 'public');
        }

        $setting->update($data);

        return redirect()
            ->route('admin.beranda.index', '#solution')
            ->with('success', '✅ Setelan Section Solusi berhasil diperbarui!');
    }

    // ==========================================
    // SOLUTION POINTS CRUD
    // ==========================================

    public function storeSolutionPoint(HomeSolutionPointRequest $request)
    {
        $maxOrder = HomeSolutionPoint::max('sort_order') ?? 0;

        HomeSolutionPoint::create([
            'title'      => $request->title,
            'sort_order' => $request->input('sort_order', $maxOrder + 1),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#solution')
            ->with('success', '✅ Poin solusi berhasil ditambahkan!');
    }

    public function updateSolutionPoint(HomeSolutionPointRequest $request, HomeSolutionPoint $point)
    {
        $point->update([
            'title'      => $request->title,
            'sort_order' => $request->input('sort_order', $point->sort_order),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#solution')
            ->with('success', '✅ Poin solusi berhasil diperbarui!');
    }

    public function destroySolutionPoint(HomeSolutionPoint $point)
    {
        $point->delete();

        return redirect()
            ->route('admin.beranda.index', '#solution')
            ->with('success', '🗑️ Poin solusi berhasil dihapus!');
    }

    public function toggleSolutionPoint(HomeSolutionPoint $point)
    {
        $point->update(['is_active' => !$point->is_active]);

        $status = $point->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "✅ Poin solusi berhasil {$status}!");
    }

    // ==========================================
    // WEBSITE LOGO
    // ==========================================

    public function updateWebsiteLogo(Request $request)
    {
        $request->validate([
            'website_logo' => 'required|image|mimes:jpg,jpeg,png,webp',
        ], [
            'website_logo.required' => 'File logo wajib diunggah.',
            'website_logo.image'    => 'File logo harus berupa gambar.',
            'website_logo.mimes'    => 'Format logo harus jpg, jpeg, png, atau webp.',
        ]);

        if ($request->hasFile('website_logo')) {
            \App\Models\Setting::upload('website_logo', $request->file('website_logo'), 'images/logo', 'website_setting');
        }

        return redirect()
            ->route('admin.beranda.index')
            ->with('success', '✅ Logo utama website berhasil diperbarui!');
    }

    // ==========================================
    // HOME PROGRAM CARDS CRUD
    // ==========================================

    public function storeProgramCard(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'badge'       => 'nullable|string|max:100',
            'description' => 'required|string',
            'sort_order'  => 'required|integer|min:0',
        ], [
            'title.required'       => 'Judul card wajib diisi.',
            'description.required' => 'Deskripsi singkat wajib diisi.',
            'sort_order.required'  => 'Urutan tampil wajib diisi.',
        ]);

        HomeProgramCard::create([
            'title'       => $request->title,
            'badge'       => $request->badge,
            'description' => $request->description,
            'sort_order'  => $request->sort_order,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#program-cards')
            ->with('success', '✅ Card program berhasil ditambahkan!');
    }

    public function updateProgramCard(Request $request, HomeProgramCard $card)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'badge'       => 'nullable|string|max:100',
            'description' => 'required|string',
            'sort_order'  => 'required|integer|min:0',
        ], [
            'title.required'       => 'Judul card wajib diisi.',
            'description.required' => 'Deskripsi singkat wajib diisi.',
            'sort_order.required'  => 'Urutan tampil wajib diisi.',
        ]);

        $card->update([
            'title'       => $request->title,
            'badge'       => $request->badge,
            'description' => $request->description,
            'sort_order'  => $request->sort_order,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#program-cards')
            ->with('success', '✅ Card program berhasil diperbarui!');
    }

    public function destroyProgramCard(HomeProgramCard $card)
    {
        $card->delete();

        return redirect()
            ->route('admin.beranda.index', '#program-cards')
            ->with('success', '🗑️ Card program berhasil dihapus!');
    }

    public function toggleProgramCard(HomeProgramCard $card)
    {
        $card->update(['is_active' => !$card->is_active]);

        $status = $card->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "✅ Card program \"{$card->title}\" berhasil {$status}!");
    }

    // ==========================================
    // WHATSAPP FLOATING CMS
    // ==========================================

    public function updateWhatsappFloating(Request $request)
    {
        $request->validate([
            'wa_floating_number' => 'required|string|max:50',
            'wa_floating_message' => 'nullable|string|max:1000',
        ], [
            'wa_floating_number.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        \App\Models\Setting::set('wa_floating_number', $request->wa_floating_number, 'whatsapp_floating');
        \App\Models\Setting::set('wa_floating_message', $request->wa_floating_message ?? '', 'whatsapp_floating');
        \App\Models\Setting::set('wa_floating_status', $request->boolean('wa_floating_status') ? '1' : '0', 'whatsapp_floating');

        return redirect()
            ->route('admin.beranda.index', '#whatsapp-floating')
            ->with('success', '✅ Pengaturan WhatsApp Floating berhasil diperbarui!');
    }
}
