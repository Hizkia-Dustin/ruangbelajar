@extends('admin.layouts.app')
@section('title', 'Kelola Kontak & FAQ')
@section('page-title', 'Kelola Kontak & FAQ')
@section('breadcrumb', 'Informasi Kontak, Hero, FAQ, dan Maps')

@section('content')
<div class="space-y-8">

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-sm font-semibold flex items-center gap-2">
        <span>✅</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- 1. HERO KONTAK CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="hero">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">✨</div>
                <h2 class="font-semibold text-gray-800">1. Hero Kontak Section</h2>
            </div>
            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Header / Top</span>
        </div>
        <form method="POST" action="{{ route('admin.kontak.update-info') }}" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Badge (Kecil paling atas)</label>
                    <input type="text" name="contact_hero_badge_text"
                           value="{{ old('contact_hero_badge_text', $settings['contact_hero_badge_text'] ?? 'PELAYANAN SEPENUH HATI') }}"
                           placeholder="PELAYANAN SEPENUH HATI"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="contact_hero_is_active" value="1"
                               {{ (old('contact_hero_is_active', $settings['contact_hero_is_active'] ?? '1') === '1') ? 'checked' : '' }}
                               class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                        <span class="text-sm font-semibold text-gray-600">Aktifkan Section Hero</span>
                    </label>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Utama (Baris 1)</label>
                    <input type="text" name="contact_hero_title_line_1"
                           value="{{ old('contact_hero_title_line_1', $settings['contact_hero_title_line_1'] ?? 'Kami Siap') }}"
                           placeholder="Kami Siap"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight (Warna & Garis Bawah)</label>
                    <input type="text" name="contact_hero_title_highlight"
                           value="{{ old('contact_hero_title_highlight', $settings['contact_hero_title_highlight'] ?? 'Mendengarkan.') }}"
                           placeholder="Mendengarkan."
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Bawah Hero</label>
                    <textarea name="contact_hero_description" rows="3"
                              placeholder="Jangan biarkan kebingungan menghambat potensi anak Anda..."
                              class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('contact_hero_description', $settings['contact_hero_description'] ?? '') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Latar Belakang (Optional)</label>
                    <div class="border border-gray-200 rounded-xl p-4 flex flex-col md:flex-row items-center gap-4">
                        @php $heroBg = $settings['contact_hero_background_image'] ?? ''; @endphp
                        @if($heroBg)
                            <img src="{{ asset('storage/'.$heroBg) }}" alt="Preview" class="h-20 w-32 object-cover rounded-lg border shadow-sm shrink-0">
                        @else
                            <div class="h-20 w-32 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400 border border-dashed shrink-0">No Image</div>
                        @endif
                        <div class="flex-1 w-full">
                            <input type="file" name="contact_hero_background_image" accept="image/*"
                                   class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                            <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG, WebP</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pt-3">
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    💾 Simpan Hero
                </button>
            </div>
        </form>
    </div>

    {{-- 2. FAQ & KONSULTASI CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="cta-section">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-sm">💬</div>
                <h2 class="font-semibold text-gray-800">2. FAQ & Konsultasi Settings</h2>
            </div>
            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2.5 py-1 rounded-full">WhatsApp CTA & FAQ Title</span>
        </div>
        <form method="POST" action="{{ route('admin.kontak.update-info') }}" class="p-6 space-y-5 border-b border-gray-100">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- FAQ Title settings --}}
                <div class="md:col-span-3 border-b border-gray-50 pb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">A. Pengaturan Judul FAQ (Sisi Kanan)</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">FAQ Badge Teks</label>
                    <input type="text" name="contact_faq_badge"
                           value="{{ old('contact_faq_badge', $settings['contact_faq_badge'] ?? 'Pertanyaan Umum') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">FAQ Judul</label>
                    <input type="text" name="contact_faq_title"
                           value="{{ old('contact_faq_title', $settings['contact_faq_title'] ?? 'Mungkin Anda') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">FAQ Highlight</label>
                    <input type="text" name="contact_faq_highlight"
                           value="{{ old('contact_faq_highlight', $settings['contact_faq_highlight'] ?? 'Bertanya.') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>

                {{-- Konsultasi settings --}}
                <div class="md:col-span-3 border-b border-gray-50 pt-3 pb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">B. Pengaturan Card Konsultasi WA (Sisi Kiri)</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Konsultasi Badge</label>
                    <input type="text" name="contact_konsultasi_badge"
                           value="{{ old('contact_konsultasi_badge', $settings['contact_konsultasi_badge'] ?? 'Respon Cepat') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Konsultasi Judul</label>
                    <input type="text" name="contact_konsultasi_title"
                           value="{{ old('contact_konsultasi_title', $settings['contact_konsultasi_title'] ?? 'Konsultasi') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Konsultasi Highlight</label>
                    <input type="text" name="contact_konsultasi_highlight"
                           value="{{ old('contact_konsultasi_highlight', $settings['contact_konsultasi_highlight'] ?? 'Gratis') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Tombol WA</label>
                    <input type="text" name="contact_konsultasi_button_text"
                           value="{{ old('contact_konsultasi_button_text', $settings['contact_konsultasi_button_text'] ?? 'Chat WhatsApp Sekarang') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">WhatsApp Number (Tanpa spasi / +)</label>
                    <input type="text" name="contact_whatsapp_number"
                           value="{{ old('contact_whatsapp_number', $settings['contact_whatsapp_number'] ?? $settings['contact_whatsapp'] ?? '6283157112597') }}"
                           placeholder="6283157112597"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Pendukung Badge (Operational/dll)</label>
                    <input type="text" name="contact_konsultasi_description"
                           value="{{ old('contact_konsultasi_description', $settings['contact_konsultasi_description'] ?? 'Admin Standby 24/7') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
            </div>
            <div class="flex justify-end pt-3">
                <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    💾 Simpan Setelan Konsultasi
                </button>
            </div>
        </form>

        {{-- Benefit list (repeatable) --}}
        <div class="p-6 bg-gray-50/50" id="cta-features">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">C. Daftar Benefit Konsultasi WA</p>
                    <p class="text-[10px] text-gray-400">Benefit/checklist di bawah judul kartu WhatsApp</p>
                </div>
                <button type="button" onclick="openCreateCtaFeature()"
                        class="px-3.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                    ➕ Tambah Benefit
                </button>
            </div>

            @if($ctaFeatures->isEmpty())
                <div class="py-6 text-center text-gray-400 text-xs bg-white rounded-xl border border-gray-100">Belum ada benefit terdaftar.</div>
            @else
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider text-[10px] border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2.5">#</th>
                                <th class="px-4 py-2.5">Teks Benefit</th>
                                <th class="px-4 py-2.5 text-center">Urutan</th>
                                <th class="px-4 py-2.5 text-center">Status</th>
                                <th class="px-4 py-2.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($ctaFeatures as $f)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium text-gray-700">{{ $f->feature_text }}</td>
                                <td class="px-4 py-3 text-center">{{ $f->sort_order }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.kontak.cta-feature.toggle', $f) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-2 py-0.5 rounded-full font-bold text-[9px] {{ $f->is_active ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                            {{ $f->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button type="button" onclick="openEditCtaFeature({{ $f->id }}, '{{ addslashes($f->feature_text) }}', {{ $f->sort_order }})"
                                                class="p-1 hover:bg-gray-100 rounded text-brand-600">
                                            ✏️
                                        </button>
                                        <form method="POST" action="{{ route('admin.kontak.cta-feature.destroy', $f) }}"
                                              onsubmit="return confirm('Hapus benefit ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1 hover:bg-red-50 rounded text-red-500">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- 3. INFORMASI KONTAK CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="info-section">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm">🏢</div>
                <h2 class="font-semibold text-gray-800">3. Informasi Kontak Detail</h2>
            </div>
            <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2.5 py-1 rounded-full">Info Cards</span>
        </div>
        <form method="POST" action="{{ route('admin.kontak.update-info') }}" class="p-6 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2 border-b border-gray-50 pb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">A. Judul Section Informasi</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Section Utama</label>
                    <input type="text" name="contact_info_section_title"
                           value="{{ old('contact_info_section_title', $settings['contact_info_section_title'] ?? 'Kunjungi') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Highlight Judul</label>
                    <input type="text" name="contact_info_section_highlight"
                           value="{{ old('contact_info_section_highlight', $settings['contact_info_section_highlight'] ?? 'Rumah Belajar Kami.') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>

                <div class="md:col-span-2 border-b border-gray-50 pt-3 pb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">B. Blok Informasi & Kontak (Icon Otomatis)</p>
                </div>

                {{-- 1. LOKASI --}}
                <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                    <p class="text-xs font-bold text-blue-600 flex items-center gap-1">📍 Lokasi (Icon: fa-location-dot)</p>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Blok</label>
                        <input type="text" name="contact_info_address_title"
                               value="{{ old('contact_info_address_title', $settings['contact_info_address_title'] ?? 'Lokasi Strategis') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Alamat Lengkap</label>
                        <textarea name="contact_info_address_text" rows="2"
                                  class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs resize-none">{{ old('contact_info_address_text', $settings['contact_info_address_text'] ?? $settings['contact_alamat'] ?? '') }}</textarea>
                    </div>
                </div>

                {{-- 2. EMAIL --}}
                <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                    <p class="text-xs font-bold text-blue-600 flex items-center gap-1">✉️ Email Support (Icon: fa-envelope)</p>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Blok</label>
                        <input type="text" name="contact_info_email_title"
                               value="{{ old('contact_info_email_title', $settings['contact_info_email_title'] ?? 'Email Support') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Alamat Email</label>
                        <input type="text" name="contact_info_email_text"
                               value="{{ old('contact_info_email_text', $settings['contact_info_email_text'] ?? $settings['contact_email'] ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                </div>

                {{-- 3. WHATSAPP --}}
                <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                    <p class="text-xs font-bold text-blue-600 flex items-center gap-1">💬 WhatsApp Admin (Icon: fa-whatsapp)</p>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Blok</label>
                        <input type="text" name="contact_info_whatsapp_title"
                               value="{{ old('contact_info_whatsapp_title', $settings['contact_info_whatsapp_title'] ?? 'WhatsApp Admin') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Nomor WA</label>
                        <input type="text" name="contact_info_whatsapp_text"
                               value="{{ old('contact_info_whatsapp_text', $settings['contact_info_whatsapp_text'] ?? $settings['contact_whatsapp'] ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                </div>

                {{-- 4. INSTAGRAM --}}
                <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                    <p class="text-xs font-bold text-blue-600 flex items-center gap-1">📸 Instagram Resmi (Icon: fa-instagram)</p>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Blok</label>
                        <input type="text" name="contact_info_instagram_title"
                               value="{{ old('contact_info_instagram_title', $settings['contact_info_instagram_title'] ?? 'Instagram Resmi') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Username IG</label>
                        <input type="text" name="contact_info_instagram_text"
                               value="{{ old('contact_info_instagram_text', $settings['contact_info_instagram_text'] ?? '@ruangbelajar.bogor') }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                    </div>
                </div>

                {{-- 5. OPERATIONAL --}}
                <div class="p-4 bg-gray-50 rounded-xl space-y-3 md:col-span-2">
                    <p class="text-xs font-bold text-blue-600 flex items-center gap-1">⏰ Jam Operasional (Icon: fa-clock)</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Blok</label>
                            <input type="text" name="contact_info_operational_title"
                                   value="{{ old('contact_info_operational_title', $settings['contact_info_operational_title'] ?? 'Jam Operasional') }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Teks Hari & Jam</label>
                            <input type="text" name="contact_info_operational_text"
                                   value="{{ old('contact_info_operational_text', $settings['contact_info_operational_text'] ?? $settings['contact_jam_operasional'] ?? '') }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs">
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-end pt-3">
                <button type="submit" class="px-5 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    💾 Simpan Informasi Kontak
                </button>
            </div>
        </form>
    </div>

    {{-- 4. GOOGLE MAPS CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="maps-section">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-red-50 to-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center text-sm">📍</div>
                <h2 class="font-semibold text-gray-800">4. Google Maps Integration</h2>
            </div>
            <span class="text-xs font-semibold text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Interactive Map</span>
        </div>
        <form method="POST" action="{{ route('admin.kontak.update-info') }}" class="p-6 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Embed Iframe URL
                        <span class="text-gray-400 font-normal ml-1">(Google Maps → Share → Embed Map → Copy src value)</span>
                    </label>
                    <div class="flex gap-2">
                        <input type="text" name="contact_maps_embed_url" id="maps-embed-input"
                               value="{{ old('contact_maps_embed_url', $settings['contact_maps_embed_url'] ?? '') }}"
                               placeholder="https://www.google.com/maps/embed?pb=..."
                               class="flex-1 px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                        <button type="button" onclick="previewMaps()"
                                class="px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-xs font-semibold transition whitespace-nowrap">
                            Preview Peta
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Latitude (Optional)</label>
                    <input type="text" name="contact_maps_latitude"
                           value="{{ old('contact_maps_latitude', $settings['contact_maps_latitude'] ?? '') }}"
                           placeholder="-6.622285"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Longitude (Optional)</label>
                    <input type="text" name="contact_maps_longitude"
                           value="{{ old('contact_maps_longitude', $settings['contact_maps_longitude'] ?? '') }}"
                           placeholder="106.815330"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Tautan Google Maps Link / Maps URL (Optional)
                        <span class="text-gray-400 font-normal ml-1">(Tautan untuk tombol "Buka di Google Maps", e.g. https://maps.app.goo.gl/...)</span>
                    </label>
                    <input type="text" name="contact_maps_url"
                           value="{{ old('contact_maps_url', $settings['contact_maps_url'] ?? '') }}"
                           placeholder="https://maps.app.goo.gl/..."
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none-brand">
                </div>

                {{-- Maps Preview --}}
                @php
                    $initialEmbed = $settings['contact_maps_embed_url'] ?? '';
                    $initialLat = $settings['contact_maps_latitude'] ?? '';
                    $initialLng = $settings['contact_maps_longitude'] ?? '';
                    $initialSrc = '';
                    if (!empty($initialLat) && !empty($initialLng)) {
                        $initialSrc = "https://www.google.com/maps?q={$initialLat},{$initialLng}&hl=id&z=15&output=embed";
                    } elseif (!empty($initialEmbed)) {
                        if (str_contains($initialEmbed, 'embed') || str_contains($initialEmbed, 'output=embed')) {
                            $initialSrc = $initialEmbed;
                        }
                    }
                @endphp
                <div class="md:col-span-2" id="maps-preview-wrap" style="{{ $initialSrc ? '' : 'display:none' }}">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Live Preview</label>
                    <div class="rounded-2xl overflow-hidden border border-gray-200 h-64 bg-gray-100 relative">
                        <iframe id="maps-iframe"
                                src="{{ $initialSrc }}"
                                width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pt-3">
                <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    💾 Simpan Google Maps
                </button>
            </div>
        </form>
    </div>

    {{-- 5. FAQ LIST CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="faq">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-sm">❓</div>
                <div>
                    <h2 class="font-semibold text-gray-800">5. FAQ / Pertanyaan Umum</h2>
                    <p class="text-[10px] text-gray-400">{{ $faqs->count() }} FAQ terdaftar</p>
                </div>
            </div>
            <button onclick="toggleModal('modal-faq')"
                    class="flex items-center gap-1.5 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded-xl transition">
                ➕ Tambah FAQ
            </button>
        </div>
        @if($faqs->isEmpty())
            <div class="py-12 text-center text-gray-400 text-sm">Belum ada FAQ. Klik "Tambah FAQ" untuk mulai.</div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($faqs as $faq)
                <div class="px-6 py-4 hover:bg-gray-50/50 transition flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 text-sm">{{ $faq->question }}</p>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $faq->answer }}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <form method="POST" action="{{ route('admin.kontak.faq.toggle', $faq) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-[10px] px-2.5 py-1 rounded-full font-bold {{ $faq->is_active ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }} transition">
                                {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                        <button onclick="openEditFaq({{ $faq->id }}, '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')"
                                class="p-1.5 text-brand-600 hover:bg-gray-100 rounded-lg transition" title="Edit">
                            ✏️
                        </button>
                        <form method="POST" action="{{ route('admin.kontak.faq.destroy', $faq) }}" onsubmit="return confirm('Hapus FAQ ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

{{-- Modal FAQ --}}
<div id="modal-faq" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-faq')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-faq-title" class="font-semibold text-gray-800">Tambah FAQ</h3>
            <button onclick="toggleModal('modal-faq')" class="text-gray-400 hover:text-gray-600">
                ❌
            </button>
        </div>
        <form id="faq-form" method="POST" action="{{ route('admin.kontak.faq.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="faq-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Pertanyaan <span class="text-red-400">*</span></label>
                <input type="text" name="question" id="faq-question" required
                       placeholder="Apakah ada sesi trial gratis?"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jawaban <span class="text-red-400">*</span></label>
                <textarea name="answer" id="faq-answer" rows="4" required
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-faq')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-purple-600 hover:bg-purple-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Benefit CTA Feature --}}
<div id="modal-cta-feature" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-cta-feature')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-cta-title" class="font-semibold text-gray-800">Tambah Benefit</h3>
            <button onclick="toggleModal('modal-cta-feature')" class="text-gray-400 hover:text-gray-600">
                ❌
            </button>
        </div>
        <form id="cta-form" method="POST" action="{{ route('admin.kontak.cta-feature.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="cta-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Benefit <span class="text-red-400">*</span></label>
                <input type="text" name="feature_text" id="cta-text" required
                       placeholder="Bantu pilih program yang tepat sesuai umur anak"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan Tampil (Semakin kecil semakin atas)</label>
                <input type="number" name="sort_order" id="cta-sort" min="0" value="0"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-cta-feature')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleModal(id) {
    const m = document.getElementById(id);
    if (m) {
        m.classList.toggle('hidden');
        m.classList.toggle('flex');
    }
}

function openCreateCtaFeature() {
    document.getElementById('cta-form').action = "{{ route('admin.kontak.cta-feature.store') }}";
    document.getElementById('cta-method').value = 'POST';
    document.getElementById('cta-text').value = '';
    document.getElementById('cta-sort').value = '0';
    document.getElementById('modal-cta-title').textContent = 'Tambah Benefit';
    toggleModal('modal-cta-feature');
}

function openEditCtaFeature(id, text, sort) {
    document.getElementById('cta-form').action = `/admin/kontak/cta-feature/${id}`;
    document.getElementById('cta-method').value = 'PUT';
    document.getElementById('cta-text').value = text;
    document.getElementById('cta-sort').value = sort;
    document.getElementById('modal-cta-title').textContent = 'Edit Benefit';
    toggleModal('modal-cta-feature');
}

function openEditFaq(id, question, answer) {
    document.getElementById('faq-form').action = `/admin/kontak/faq/${id}`;
    document.getElementById('faq-method').value = 'PUT';
    document.getElementById('faq-question').value = question;
    document.getElementById('faq-answer').value = answer;
    document.getElementById('modal-faq-title').textContent = 'Edit FAQ';
    toggleModal('modal-faq');
}

function previewMaps() {
    const embedInput = document.getElementById('maps-embed-input');
    const latInput = document.getElementsByName('contact_maps_latitude')[0];
    const lngInput = document.getElementsByName('contact_maps_longitude')[0];

    const embedUrl = embedInput ? embedInput.value.trim() : '';
    const lat = latInput ? latInput.value.trim() : '';
    const lng = lngInput ? lngInput.value.trim() : '';

    let iframeSrc = '';
    if (lat && lng) {
        iframeSrc = `https://www.google.com/maps?q=${lat},${lng}&hl=id&z=15&output=embed`;
    } else if (embedUrl) {
        if (embedUrl.includes('embed') || embedUrl.includes('output=embed')) {
            iframeSrc = embedUrl;
        }
    }

    const iframe = document.getElementById('maps-iframe');
    const previewWrap = document.getElementById('maps-preview-wrap');
    if (iframeSrc && iframe && previewWrap) {
        iframe.src = iframeSrc;
        previewWrap.style.display = '';
    } else if (previewWrap) {
        previewWrap.style.display = 'none';
    }
}
</script>
@endpush
