<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * FooterAdminController
 * CMS footer website (deskripsi, copyright, CTA, logo).
 */
class FooterAdminController extends Controller
{
    public function index()
    {
        $footer      = FooterSetting::getInstance();
        $socialMedia = SocialMedia::orderBy('sort_order')->get();

        return view('admin.footer.index', compact('footer', 'socialMedia'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_name'           => 'nullable|string|max:255',
            'description'          => 'nullable|string',
            'footer_description'   => 'nullable|string',
            'email'                => 'nullable|email|max:255',
            'phone'                => 'nullable|string|max:20',
            'address'              => 'nullable|string',
            'copyright_text'       => 'nullable|string|max:255',
            'footer_cta_title'     => 'nullable|string|max:255',
            'footer_cta_subtitle'  => 'nullable|string|max:255',
            'footer_cta_button_text' => 'nullable|string|max:100',
            'footer_cta_button_url'  => 'nullable|url|max:500',
        ]);

        $footer = FooterSetting::getInstance();
        $data   = $request->only([
            'brand_name', 'description', 'footer_description',
            'email', 'phone', 'address', 'copyright_text',
            'footer_cta_title', 'footer_cta_subtitle',
            'footer_cta_button_text', 'footer_cta_button_url',
        ]);

        if ($footer->exists) {
            $footer->update($data);
        } else {
            FooterSetting::create($data);
        }

        return redirect()->route('admin.footer.index')
            ->with('success', '✅ Setting footer berhasil diperbarui!');
    }
}
