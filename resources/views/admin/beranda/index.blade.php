@extends('admin.layouts.app')
@section('title', 'Beranda')
@section('page-title', 'CMS Beranda')
@section('breadcrumb', 'Kelola konten halaman beranda')

@section('content')
<div class="space-y-8">

    {{-- ============ SECTION 0: LOGO WEBSITE ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="logo-website">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center text-sm">
                🖼️
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Logo Website / Navbar</h2>
                <p class="text-xs text-gray-400">Kelola logo utama website yang tampil di navbar semua halaman (tanpa batas 2MB)</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.beranda.website-logo.update') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Logo Utama Website (Navbar Kiri Atas)</label>
                @php
                    $siteLogo = \App\Models\Setting::get('website_logo');
                @endphp
                <div class="flex flex-col sm:flex-row gap-6 items-center">
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition-colors w-full sm:w-2/3" id="logo-top-drop-zone">
                        {{-- Preview --}}
                        <div id="logo-top-preview-wrap" class="{{ $siteLogo ? '' : 'hidden' }} mb-4">
                            <img id="logo-top-preview-img"
                                 src="{{ $siteLogo ? asset('storage/'.$siteLogo) : '' }}"
                                 alt="Preview Logo" class="mx-auto max-h-16 rounded-xl object-contain shadow px-4 bg-gray-50 border">
                            <p class="text-xs text-gray-400 mt-2">Logo saat ini</p>
                        </div>
                        <div id="logo-top-placeholder" class="{{ $siteLogo ? 'hidden' : '' }}">
                            <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-400">Klik atau drag & drop gambar logo baru</p>
                        </div>
                        <input type="file" name="website_logo" id="website_logo_top" accept="image/*"
                               class="hidden" onchange="previewImage(this, 'logo-top-preview-img', 'logo-top-preview-wrap', 'logo-top-placeholder')">
                        <button type="button" onclick="document.getElementById('website_logo_top').click()"
                                class="mt-3 px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                            {{ $siteLogo ? 'Ganti Logo' : 'Pilih Logo' }}
                        </button>
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP</p>
                        @error('website_logo')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full sm:w-1/3 text-center sm:text-left space-y-3">
                        <button type="submit" class="w-full px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center justify-center gap-2">
                            Simpan Logo
                        </button>
                        <p class="text-xs text-gray-400 leading-relaxed">Disarankan menggunakan gambar transparan horizontal berformat PNG atau WebP agar tampil rapi di navbar.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- ============ SECTION 1: HERO ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="hero">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Hero Section</h2>
                <p class="text-xs text-gray-400">Teks utama, deskripsi, tombol, dan gambar hero</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.beranda.hero.update') }}" enctype="multipart/form-data" id="hero-form">
            @csrf @method('PUT')
            <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Kolom Kiri --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge Text <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $setting->badge_text) }}"
                               placeholder="Unlock Your Future Potential"
                               class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('badge_text') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('badge_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Utama <span class="text-red-400">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $setting->title) }}"
                               placeholder="Bukan Sekadar Belajar,"
                               class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('title') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                        <input type="text" name="highlighted_title" value="{{ old('highlighted_title', $setting->highlighted_title) }}"
                               placeholder="Tapi Juara!"
                               class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('highlighted_title') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <p class="mt-1 text-xs text-gray-400">Kata ini akan tampil dengan warna/style berbeda di frontend.</p>
                        @error('highlighted_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                        <textarea name="description" rows="3"
                                  placeholder="Platform bimbingan belajar dengan pendekatan personal..."
                                  class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $setting->description) }}</textarea>
                        @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Tombol <span class="text-red-400">*</span></label>
                            <input type="text" name="button_text" value="{{ old('button_text', $setting->button_text) }}"
                                   placeholder="Daftar Program"
                                   class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('button_text') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            @error('button_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Link Tombol <span class="text-red-400">*</span></label>
                            <input type="text" name="button_link" value="{{ old('button_link', $setting->button_link) }}"
                                   placeholder="/register"
                                   class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('button_link') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            @error('button_link')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Upload Gambar Hero & Logo Website --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Hero</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition-colors" id="hero-drop-zone">
                            {{-- Preview --}}
                            <div id="hero-preview-wrap" class="{{ $setting->hero_image ? '' : 'hidden' }} mb-4">
                                <img id="hero-preview-img"
                                     src="{{ $setting->hero_image ? asset('storage/'.$setting->hero_image) : '' }}"
                                     alt="Preview" class="mx-auto max-h-48 rounded-xl object-cover shadow">
                                <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
                            </div>
                            <div id="hero-placeholder" class="{{ $setting->hero_image ? 'hidden' : '' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-400">Klik atau drag & drop gambar</p>
                            </div>
                            <input type="file" name="hero_image" id="hero_image" accept="image/*"
                                   class="hidden" onchange="previewImage(this, 'hero-preview-img', 'hero-preview-wrap', 'hero-placeholder')">
                            <button type="button" onclick="document.getElementById('hero_image').click()"
                                    class="mt-3 px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                                {{ $setting->hero_image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                            </button>
                            <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP</p>
                            @error('hero_image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION 2: STATISTIK ============ --}}
            <div class="px-6 pb-2">
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 bg-yellow-100 text-yellow-600 rounded flex items-center justify-center text-xs">📊</span>
                        Statistik (Angka yang tampil di halaman beranda)
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-blue-50 rounded-2xl p-4">
                            <label class="block text-xs font-semibold text-blue-600 mb-2">👥 Total Siswa Aktif</label>
                            <input type="number" name="total_students" value="{{ old('total_students', $setting->total_students) }}"
                                   min="0" placeholder="100"
                                   class="w-full px-3 py-2 bg-white border border-blue-200 rounded-xl text-sm font-bold text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
                            @error('total_students')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="bg-purple-50 rounded-2xl p-4">
                            <label class="block text-xs font-semibold text-purple-600 mb-2">🎓 Total Program</label>
                            <input type="number" name="total_programs" value="{{ old('total_programs', $setting->total_programs) }}"
                                   min="0" placeholder="5"
                                   class="w-full px-3 py-2 bg-white border border-purple-200 rounded-xl text-sm font-bold text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-200 transition">
                            @error('total_programs')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="bg-green-50 rounded-2xl p-4">
                            <label class="block text-xs font-semibold text-green-600 mb-2">🏆 Total Tutor</label>
                            <input type="number" name="total_tutors" value="{{ old('total_tutors', $setting->total_tutors) }}"
                                   min="0" placeholder="15"
                                   class="w-full px-3 py-2 bg-white border border-green-200 rounded-xl text-sm font-bold text-green-700 focus:outline-none focus:ring-2 focus:ring-green-200 transition">
                            @error('total_tutors')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 pb-5 flex justify-end gap-3 mt-2">
                <a href="{{ route('home') }}" target="_blank"
                   class="px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                <button type="submit" id="hero-submit"
                        class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- ============ SECTION 3: KEUNGGULAN ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="keunggulan">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-yellow-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-yellow-100 text-yellow-700 rounded-lg flex items-center justify-center text-sm">⭐</div>
                <div>
                    <h2 class="font-semibold text-gray-800 text-sm">Keunggulan</h2>
                    <p class="text-xs text-gray-400">{{ $keunggulans->count() }} item terdaftar · {{ $keunggulans->where('is_active', true)->count() }} aktif</p>
                </div>
            </div>
            <button onclick="toggleModal('modal-tambah')"
                    class="flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Keunggulan
            </button>
        </div>

        {{-- Tabel Keunggulan --}}
        <div class="overflow-x-auto">
            @if($keunggulans->isEmpty())
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">⭐</div>
                    <p class="text-sm font-medium">Belum ada keunggulan</p>
                    <p class="text-xs mt-1">Klik tombol "Tambah Keunggulan" untuk memulai.</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Icon (Otomatis)</th>
                            <th class="px-6 py-3 text-left">Judul & Deskripsi</th>
                            <th class="px-6 py-3 text-center">Urutan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($keunggulans as $i => $item)
                        <tr class="hover:bg-gray-50 transition {{ $item->is_active ? '' : 'opacity-50' }}">
                            <td class="px-6 py-4 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="w-9 h-9 bg-blue-50 text-brand-600 rounded-xl flex items-center justify-center">
                                    <i class="{{ $item->display_icon }}"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $item->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">{{ $item->sort_order }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.beranda.keunggulan.toggle', $item) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition
                                                   {{ $item->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.beranda.keunggulan.edit', $item) }}"
                                       class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.beranda.keunggulan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus keunggulan \'{{ addslashes($item->title) }}\'?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- ============ SECTION 3.5: CARD PROGRAM BERANDA ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="program-cards">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-purple-100 text-purple-700 rounded-lg flex items-center justify-center text-sm">📦</div>
                <div>
                    <h2 class="font-semibold text-gray-800 text-sm">Card Program Beranda (Kanan)</h2>
                    <p class="text-xs text-gray-400">{{ $programCards->count() }} card terdaftar · {{ $programCards->where('is_active', true)->count() }} aktif</p>
                </div>
            </div>
            <button onclick="toggleModal('modal-tambah-card')"
                    class="flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Card Program
            </button>
        </div>

        {{-- Tabel Card Program --}}
        <div class="overflow-x-auto">
            @if($programCards->isEmpty())
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">📦</div>
                    <p class="text-sm font-medium">Belum ada card program</p>
                    <p class="text-xs mt-1">Klik tombol "Tambah Card Program" untuk memulai.</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Icon (Otomatis)</th>
                            <th class="px-6 py-3 text-left">Badge</th>
                            <th class="px-6 py-3 text-left">Judul & Deskripsi</th>
                            <th class="px-6 py-3 text-center">Urutan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($programCards as $i => $item)
                        <tr class="hover:bg-gray-50 transition {{ $item->is_active ? '' : 'opacity-50' }}">
                            <td class="px-6 py-4 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="w-9 h-9 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="{{ $item->display_icon }}"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->badge)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ $item->badge }}</span>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $item->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">{{ $item->sort_order }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.beranda.program-card.toggle', $item) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition
                                                   {{ $item->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                            onclick="openEditCardModal({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->badge ?? '') }}', '{{ addslashes($item->description) }}', {{ $item->sort_order }}, {{ $item->is_active ? 1 : 0 }})"
                                            class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.beranda.program-card.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus card program \'{{ addslashes($item->title) }}\'?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- ============ SECTION 4: SOLUTION ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="solution">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center text-sm">💡</div>
                <div>
                    <h2 class="font-semibold text-gray-800 text-sm">Solution Section</h2>
                    <p class="text-xs text-gray-400">Pengaturan konten masalah vs solusi beserta poin-poin ceklisnya</p>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8 border-b border-gray-100">
            {{-- Pengaturan Utama Solusi --}}
            <form method="POST" action="{{ route('admin.beranda.solution.update') }}" enctype="multipart/form-data" id="solution-form" class="space-y-4">
                @csrf @method('PUT')
                <div class="flex items-center justify-between pb-2 border-b border-gray-50">
                    <h3 class="text-sm font-semibold text-gray-700">Konten Text & Gambar</h3>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="solution-is-active" value="1" 
                               {{ $solutionSetting->is_active ? 'checked' : '' }}
                               class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500">
                        <label for="solution-is-active" class="text-xs font-semibold text-gray-600">Aktifkan Section</label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Small Label <span class="text-red-400">*</span></label>
                        <input type="text" name="small_label" value="{{ old('small_label', $solutionSetting->small_label) }}" required
                               placeholder="THE SOLUTION"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('small_label')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Title Line 1 <span class="text-red-400">*</span></label>
                        <input type="text" name="title_line_1" value="{{ old('title_line_1', $solutionSetting->title_line_1) }}" required
                               placeholder="Ubah"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('title_line_1')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Title Highlight <span class="text-red-400">*</span></label>
                        <input type="text" name="title_highlight" value="{{ old('title_highlight', $solutionSetting->title_highlight) }}" required
                               placeholder="Kebingungan"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition text-brand-blue font-semibold">
                        @error('title_highlight')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Title Line 2 <span class="text-red-400">*</span></label>
                        <input type="text" name="title_line_2" value="{{ old('title_line_2', $solutionSetting->title_line_2) }}" required
                               placeholder="Menjadi"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('title_line_2')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Title Yellow <span class="text-red-400">*</span></label>
                        <input type="text" name="title_yellow" value="{{ old('title_yellow', $solutionSetting->title_yellow) }}" required
                               placeholder="Kepercayaan Diri."
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition text-yellow-600 font-semibold">
                        @error('title_yellow')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="4" required
                              placeholder="Banyak siswa terjebak dalam metode hafalan yang membosankan..."
                              class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $solutionSetting->description) }}</textarea>
                    @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Solusi</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition-colors" id="solution-drop-zone">
                        {{-- Preview --}}
                        <div id="solution-preview-wrap" class="{{ $solutionSetting->image ? '' : 'hidden' }} mb-4">
                            <img id="solution-preview-img"
                                 src="{{ $solutionSetting->image ? asset('storage/'.$solutionSetting->image) : '' }}"
                                 alt="Preview" class="mx-auto max-h-40 rounded-xl object-cover shadow">
                            <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
                        </div>
                        <div id="solution-placeholder" class="{{ $solutionSetting->image ? 'hidden' : '' }}">
                            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-xs text-gray-400">Klik atau drag & drop gambar</p>
                        </div>
                        <input type="file" name="image" id="solution_image" accept="image/*"
                               class="hidden" onchange="previewImage(this, 'solution-preview-img', 'solution-preview-wrap', 'solution-placeholder')">
                        <button type="button" onclick="document.getElementById('solution_image').click()"
                                class="mt-2 px-3 py-1.5 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                            {{ $solutionSetting->image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                        </button>
                        <p class="text-xs text-gray-400 mt-1.5">JPG, PNG, WebP</p>
                        @error('image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Konten Solusi
                    </button>
                </div>
            </form>

            {{-- CRUD Solution Points --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-gray-50">
                    <h3 class="text-sm font-semibold text-gray-700">Daftar Poin Solusi</h3>
                    <button onclick="toggleModal('modal-tambah-point')"
                            class="px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Poin
                    </button>
                </div>

                <div class="overflow-x-auto max-h-[460px] overflow-y-auto border border-gray-100 rounded-xl">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-500 uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-4 py-2.5">Judul Poin</th>
                                <th class="px-4 py-2.5 text-center">Urutan</th>
                                <th class="px-4 py-2.5 text-center">Status</th>
                                <th class="px-4 py-2.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($solutionPoints as $point)
                            <tr class="hover:bg-gray-50 transition {{ $point->is_active ? '' : 'opacity-50' }}">
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $point->title }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-[10px] font-bold">{{ $point->sort_order }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.beranda.solution-point.toggle', $point) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="px-2 py-0.5 rounded-full text-[10px] font-semibold transition
                                                       {{ $point->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                            {{ $point->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick="openEditPointModal({{ $point->id }}, '{{ addslashes($point->title) }}', {{ $point->sort_order }}, {{ $point->is_active ? 1 : 0 }})"
                                                class="p-1.5 text-brand-600 hover:bg-brand-50 rounded transition" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form method="POST" action="{{ route('admin.beranda.solution-point.destroy', $point) }}"
                                              onsubmit="return confirm('Hapus poin solusi \'{{ addslashes($point->title) }}\'?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition" title="Hapus">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400">Belum ada poin solusi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>{{-- /space-y-8 --}}

{{-- ============ MODAL TAMBAH KEUNGGULAN ============ --}}
<div id="modal-tambah" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-tambah')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Keunggulan Baru</h3>
            <button onclick="toggleModal('modal-tambah')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.beranda.keunggulan.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan <span class="text-gray-400 font-normal">(sort)</span></label>
                <input type="number" name="sort_order" min="0" value="{{ $keunggulans->count() + 1 }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul <span class="text-red-400">*</span></label>
                <input type="text" name="title" required placeholder="Personal"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required placeholder="Setiap siswa memiliki porsi perhatian eksklusif..."
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="modal-is-active" value="1" checked
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="modal-is-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-tambah')"
                        class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Keunggulan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL TAMBAH POIN SOLUSI ============ --}}
<div id="modal-tambah-point" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-tambah-point')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Poin Solusi Baru</h3>
            <button type="button" onclick="toggleModal('modal-tambah-point')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.beranda.solution-point.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Poin <span class="text-red-400">*</span></label>
                <input type="text" name="title" required placeholder="Contoh: Kuis interaktif"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan <span class="text-gray-400 font-normal">(sort)</span></label>
                <input type="number" name="sort_order" min="0" value="{{ $solutionPoints->count() + 1 }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="point-is-active" value="1" checked
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="point-is-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-tambah-point')"
                        class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Poin
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL EDIT POIN SOLUSI ============ --}}
<div id="modal-edit-point" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-edit-point')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Edit Poin Solusi</h3>
            <button type="button" onclick="toggleModal('modal-edit-point')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="form-edit-point" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Poin <span class="text-red-400">*</span></label>
                <input type="text" name="title" id="edit-point-title" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan <span class="text-gray-400 font-normal">(sort)</span></label>
                <input type="number" name="sort_order" id="edit-point-order" min="0"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="edit-point-is-active" value="1"
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="edit-point-is-active" class="text-sm text-gray-600">Aktif (Tampil di website)</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-edit-point')"
                        class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL TAMBAH CARD PROGRAM ============ --}}
<div id="modal-tambah-card" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-tambah-card')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Card Program Baru</h3>
            <button onclick="toggleModal('modal-tambah-card')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.beranda.program-card.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Card <span class="text-red-400">*</span></label>
                <input type="text" name="title" required placeholder="Pra-Sekolah"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="badge" placeholder="Special / Populer"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Singkat <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required placeholder="Mempersiapkan motorik & sosialisasi dini."
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan <span class="text-red-400">*</span></label>
                <input type="number" name="sort_order" min="0" value="{{ $programCards->count() + 1 }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="card-is-active" value="1" checked
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="card-is-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-tambah-card')"
                        class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Card
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL EDIT CARD PROGRAM ============ --}}
<div id="modal-edit-card" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-edit-card')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Edit Card Program</h3>
            <button type="button" onclick="toggleModal('modal-edit-card')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="form-edit-card" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Card <span class="text-red-400">*</span></label>
                <input type="text" name="title" id="edit-card-title" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="badge" id="edit-card-badge"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Singkat <span class="text-red-400">*</span></label>
                <textarea name="description" id="edit-card-description" rows="3" required
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan <span class="text-red-400">*</span></label>
                <input type="number" name="sort_order" id="edit-card-order" min="0" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="edit-card-is-active" value="1"
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="edit-card-is-active" class="text-sm text-gray-600">Aktif (Tampil di beranda)</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-edit-card')"
                        class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}

function previewImage(input, imgId, wrapId, placeholderId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(wrapId).classList.remove('hidden');
            document.getElementById(placeholderId).classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Open modal edit point & populate fields
function openEditPointModal(id, title, sortOrder, isActive) {
    const form = document.getElementById('form-edit-point');
    form.action = `/admin/beranda/solution-point/${id}`;
    
    document.getElementById('edit-point-title').value = title;
    document.getElementById('edit-point-order').value = sortOrder;
    document.getElementById('edit-point-is-active').checked = isActive === 1;
    
    toggleModal('modal-edit-point');
}

// Open modal edit card & populate fields
function openEditCardModal(id, title, badge, description, sortOrder, isActive) {
    const form = document.getElementById('form-edit-card');
    form.action = `/admin/beranda/program-card/${id}`;
    
    document.getElementById('edit-card-title').value = title;
    document.getElementById('edit-card-badge').value = badge;
    document.getElementById('edit-card-description').value = description;
    document.getElementById('edit-card-order').value = sortOrder;
    document.getElementById('edit-card-is-active').checked = isActive === 1;
    
    toggleModal('modal-edit-card');
}

// Drag & drop logo top website
const logoTopDropZone = document.getElementById('logo-top-drop-zone');
if (logoTopDropZone) {
    logoTopDropZone.addEventListener('dragover', e => { e.preventDefault(); logoTopDropZone.classList.add('border-brand-400', 'bg-brand-50'); });
    logoTopDropZone.addEventListener('dragleave', () => logoTopDropZone.classList.remove('border-brand-400', 'bg-brand-50'));
    logoTopDropZone.addEventListener('drop', e => {
        e.preventDefault();
        logoTopDropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('website_logo_top').files = dt.files;
            previewImage(document.getElementById('website_logo_top'), 'logo-top-preview-img', 'logo-top-preview-wrap', 'logo-top-placeholder');
        }
    });
}

// Loading state pada submit Hero Form
document.getElementById('hero-form').addEventListener('submit', function() {
    const btn = document.getElementById('hero-submit');
    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`;
});

// Drag & drop gambar Hero
const dropZone = document.getElementById('hero-drop-zone');
if (dropZone) {
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-brand-400', 'bg-brand-50'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-brand-400', 'bg-brand-50'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('hero_image').files = dt.files;
            previewImage(document.getElementById('hero_image'), 'hero-preview-img', 'hero-preview-wrap', 'hero-placeholder');
        }
    });
}

// Drag & drop gambar Solusi
const solutionDropZone = document.getElementById('solution-drop-zone');
if (solutionDropZone) {
    solutionDropZone.addEventListener('dragover', e => { e.preventDefault(); solutionDropZone.classList.add('border-brand-400', 'bg-brand-50'); });
    solutionDropZone.addEventListener('dragleave', () => solutionDropZone.classList.remove('border-brand-400', 'bg-brand-50'));
    solutionDropZone.addEventListener('drop', e => {
        e.preventDefault();
        solutionDropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('solution_image').files = dt.files;
            previewImage(document.getElementById('solution_image'), 'solution-preview-img', 'solution-preview-wrap', 'solution-placeholder');
        }
    });
}
</script>
@endpush
