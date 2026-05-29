<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ContactFaq;
use App\Models\ContactCtaFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * KontakAdminController
 * CMS single-page untuk kelola info kontak, jam operasional, maps, FAQ, dan CTA fitur.
 */
class KontakAdminController extends Controller
{
    public function index()
    {
        // Ambil semua setting kontak
        $settings = Setting::whereIn('group', [
            'contact_hero', 'contact_cta', 'contact_operational',
            'contact_location', 'contact_maps', 'contact_info',
        ])->pluck('value', 'key');

        $faqs        = ContactFaq::orderBy('sort_order')->get();
        $ctaFeatures = ContactCtaFeature::orderBy('sort_order')->get();

        return view('admin.kontak.index', compact('settings', 'faqs', 'ctaFeatures'));
    }

    // ---- Update Info Kontak ----

    public function updateInfo(Request $request)
    {
        $request->validate([
            // Hero
            'contact_hero_badge_text'       => 'nullable|string|max:255',
            'contact_hero_title_line_1'     => 'nullable|string|max:255',
            'contact_hero_title_highlight'  => 'nullable|string|max:255',
            'contact_hero_description'      => 'nullable|string',
            'contact_hero_background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            // FAQ & Konsultasi
            'contact_faq_badge'             => 'nullable|string|max:255',
            'contact_faq_title'             => 'nullable|string|max:255',
            'contact_faq_highlight'         => 'nullable|string|max:255',
            'contact_konsultasi_badge'      => 'nullable|string|max:255',
            'contact_konsultasi_title'      => 'nullable|string|max:255',
            'contact_konsultasi_highlight'  => 'nullable|string|max:255',
            'contact_konsultasi_button_text'=> 'nullable|string|max:255',
            'contact_konsultasi_description'=> 'nullable|string',
            'contact_whatsapp_number'       => 'nullable|string|max:255',

            // Informasi Kontak
            'contact_info_section_title'    => 'nullable|string|max:255',
            'contact_info_section_highlight'=> 'nullable|string|max:255',
            'contact_info_address_title'    => 'nullable|string|max:255',
            'contact_info_address_text'     => 'nullable|string',
            'contact_info_email_title'      => 'nullable|string|max:255',
            'contact_info_email_text'       => 'nullable|string|max:255',
            'contact_info_whatsapp_title'   => 'nullable|string|max:255',
            'contact_info_whatsapp_text'    => 'nullable|string|max:255',
            'contact_info_instagram_title'  => 'nullable|string|max:255',
            'contact_info_instagram_text'   => 'nullable|string|max:255',
            'contact_info_operational_title'=> 'nullable|string|max:255',
            'contact_info_operational_text' => 'nullable|string|max:255',

            // Google Maps
            'contact_maps_embed_url'        => 'nullable|string',
            'contact_maps_latitude'         => 'nullable|numeric',
            'contact_maps_longitude'        => 'nullable|numeric',
            'contact_maps_url'              => 'nullable|string',
        ]);

        $keys = [
            // New Hero keys
            'contact_hero_badge_text', 'contact_hero_title_line_1', 'contact_hero_title_highlight', 'contact_hero_description',
            
            // New FAQ & Konsultasi keys
            'contact_faq_badge', 'contact_faq_title', 'contact_faq_highlight',
            'contact_konsultasi_badge', 'contact_konsultasi_title', 'contact_konsultasi_highlight',
            'contact_konsultasi_button_text', 'contact_konsultasi_description', 'contact_whatsapp_number',

            // New Info keys
            'contact_info_section_title', 'contact_info_section_highlight',
            'contact_info_address_title', 'contact_info_address_text',
            'contact_info_email_title', 'contact_info_email_text',
            'contact_info_whatsapp_title', 'contact_info_whatsapp_text',
            'contact_info_instagram_title', 'contact_info_instagram_text',
            'contact_info_operational_title', 'contact_info_operational_text',

            // Maps & Legacy keys
            'contact_nama_lembaga', 'contact_alamat', 'contact_whatsapp',
            'contact_email', 'contact_jam_operasional',
            'contact_maps_embed_url', 'contact_maps_latitude', 'contact_maps_longitude', 'contact_maps_url',
            'contact_location_address', 'contact_location_email', 'contact_location_phone',
            'contact_cta_whatsapp_number', 'contact_operational_days',
            'contact_operational_open_time', 'contact_operational_close_time',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $this->resolveGroup($key)]
                );
            }
        }

        // Sync legacy keys automatically to avoid breaking footer/other pages
        if ($request->has('contact_whatsapp_number')) {
            Setting::set('contact_whatsapp', $request->contact_whatsapp_number, 'contact_info');
            Setting::set('contact_cta_whatsapp_number', $request->contact_whatsapp_number, 'contact_cta');
        }
        if ($request->has('contact_info_address_text')) {
            Setting::set('contact_alamat', $request->contact_info_address_text, 'contact_info');
            Setting::set('contact_location_address', $request->contact_info_address_text, 'contact_location');
        }
        if ($request->has('contact_info_email_text')) {
            Setting::set('contact_email', $request->contact_info_email_text, 'contact_info');
            Setting::set('contact_location_email', $request->contact_info_email_text, 'contact_location');
        }
        if ($request->has('contact_info_operational_text')) {
            Setting::set('contact_jam_operasional', $request->contact_info_operational_text, 'contact_info');
        }

        // Handle file upload
        if ($request->hasFile('contact_hero_background_image')) {
            Setting::upload('contact_hero_background_image', $request->file('contact_hero_background_image'), 'images/contact', 'contact_hero');
        }

        // Set checkbox is_active
        Setting::set('contact_hero_is_active', $request->has('contact_hero_is_active') ? '1' : '0', 'contact_hero');

        return redirect()->route('admin.kontak.index')
            ->with('success', '✅ Informasi kontak berhasil diperbarui!');
    }

    // ---- FAQ CRUD ----

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        $maxOrder = ContactFaq::max('sort_order') ?? 0;

        ContactFaq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'sort_order' => $maxOrder + 1,
            'is_active'  => true,
            'status'     => 'active',
        ]);

        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '✅ FAQ berhasil ditambahkan!');
    }

    public function updateFaq(Request $request, ContactFaq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer,
        ]);

        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '✅ FAQ berhasil diperbarui!');
    }

    public function destroyFaq(ContactFaq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '🗑️ FAQ berhasil dihapus!');
    }

    public function toggleFaq(ContactFaq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active, 'status' => $faq->is_active ? 'inactive' : 'active']);
        return redirect()->back()->with('success', '✅ Status FAQ diubah!');
    }

    // ---- Benefit CTA CRUD ----

    public function storeCtaFeature(Request $request)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $maxOrder = ContactCtaFeature::max('sort_order') ?? 0;

        ContactCtaFeature::create([
            'feature_text' => $request->feature_text,
            'icon'         => 'fas fa-check', // Icon otomatis fa-check
            'sort_order'   => $request->sort_order ?? ($maxOrder + 1),
            'is_active'    => true,
        ]);

        return redirect()->route('admin.kontak.index', '#cta-features')
            ->with('success', '✅ Benefit berhasil ditambahkan!');
    }

    public function updateCtaFeature(Request $request, ContactCtaFeature $feature)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $feature->update([
            'feature_text' => $request->feature_text,
            'sort_order'   => $request->sort_order ?? $feature->sort_order,
        ]);

        return redirect()->route('admin.kontak.index', '#cta-features')
            ->with('success', '✅ Benefit berhasil diperbarui!');
    }

    public function destroyCtaFeature(ContactCtaFeature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.kontak.index', '#cta-features')
            ->with('success', '🗑️ Benefit berhasil dihapus!');
    }

    public function toggleCtaFeature(ContactCtaFeature $feature)
    {
        $feature->update(['is_active' => !$feature->is_active]);
        return redirect()->back()->with('success', '✅ Status benefit berhasil diubah!');
    }

    private function resolveGroup(string $key): string
    {
        if (str_starts_with($key, 'contact_hero'))         return 'contact_hero';
        if (str_starts_with($key, 'contact_cta'))          return 'contact_cta';
        if (str_starts_with($key, 'contact_faq'))          return 'contact_faq';
        if (str_starts_with($key, 'contact_konsultasi'))   return 'contact_konsultasi';
        if (str_starts_with($key, 'contact_operational'))  return 'contact_operational';
        if (str_starts_with($key, 'contact_location'))     return 'contact_location';
        if (str_starts_with($key, 'contact_maps'))         return 'contact_maps';
        if (str_starts_with($key, 'contact_info'))         return 'contact_info';
        return 'contact_info';
    }
}
