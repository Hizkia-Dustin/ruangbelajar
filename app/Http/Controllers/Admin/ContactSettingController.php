<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * ContactSettingController: mengelola konten statis halaman Kontak.
 * Section: Hero, WhatsApp CTA, Operasional, Lokasi, dan Google Maps.
 * Semua data disimpan di tabel 'settings' dengan prefix group 'contact_*'.
 */
class ContactSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', [
            'contact_hero', 'contact_cta', 'contact_operational',
            'contact_location', 'contact_maps',
        ])->pluck('value', 'key');

        return view('admin.contact.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_hero_background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'contact_cta_image'             => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'contact_location_image'        => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'contact_maps_latitude'         => 'nullable|numeric',
            'contact_maps_longitude'        => 'nullable|numeric',
            'contact_maps_zoom_level'       => 'nullable|integer|min:1|max:21',
        ]);

        $textKeys = [
            // Hero
            'contact_hero_badge_text', 'contact_hero_title_line_1',
            'contact_hero_title_highlight', 'contact_hero_description',

            // WhatsApp CTA
            'contact_cta_badge_text', 'contact_cta_title', 'contact_cta_highlighted_text',
            'contact_cta_description', 'contact_cta_whatsapp_number',
            'contact_cta_button_text', 'contact_cta_button_link', 'contact_cta_status',

            // Operasional
            'contact_operational_title', 'contact_operational_days',
            'contact_operational_open_time', 'contact_operational_close_time',
            'contact_operational_timezone', 'contact_operational_icon',

            // Lokasi
            'contact_location_title', 'contact_location_highlighted_text',
            'contact_location_description', 'contact_location_address',
            'contact_location_city', 'contact_location_province',
            'contact_location_country', 'contact_location_postal_code',
            'contact_location_email', 'contact_location_phone',

            // Google Maps
            'contact_maps_embed_url', 'contact_maps_latitude', 'contact_maps_longitude',
            'contact_maps_zoom_level', 'contact_maps_marker_title', 'contact_maps_marker_description',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $this->resolveGroup($key)]
                );
            }
        }

        // Upload Hero Background
        if ($request->hasFile('contact_hero_background_image')) {
            $this->replaceImage('contact_hero_background_image', 'images/contact/hero');
        }

        // Upload CTA Image
        if ($request->hasFile('contact_cta_image')) {
            $this->replaceImage('contact_cta_image', 'images/contact/cta');
        }

        // Upload Location Image
        if ($request->hasFile('contact_location_image')) {
            $this->replaceImage('contact_location_image', 'images/contact/location');
        }

        return redirect()->route('admin.contact.settings.index')
            ->with('success', '✅ Pengaturan halaman Kontak berhasil diperbarui!');
    }

    private function resolveGroup(string $key): string
    {
        if (str_starts_with($key, 'contact_hero'))         return 'contact_hero';
        if (str_starts_with($key, 'contact_cta'))          return 'contact_cta';
        if (str_starts_with($key, 'contact_operational'))  return 'contact_operational';
        if (str_starts_with($key, 'contact_location'))     return 'contact_location';
        if (str_starts_with($key, 'contact_maps'))         return 'contact_maps';
        return 'contact_general';
    }

    private function replaceImage(string $key, string $folder): void
    {
        $old = Setting::where('key', $key)->value('value');
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $path = request()->file($key)->store($folder, 'public');
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $path, 'group' => $this->resolveGroup($key)]
        );
    }
}
