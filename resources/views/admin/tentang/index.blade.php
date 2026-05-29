@extends('admin.layouts.app')
@section('title', 'Tentang Kami')
@section('page-title', 'CMS Tentang Kami')
@section('breadcrumb', 'Kelola konten halaman Tentang Kami')

@section('content')
<div class="space-y-8">

    {{-- ============ SECTION 1: HERO & VISI MISI ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="hero">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
            <div class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Hero Section & Visi Misi</h2>
                <p class="text-xs text-gray-400">Teks utama halaman, visi, dan misi</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.tentang.setting.update') }}" enctype="multipart/form-data" id="setting-form">
            @csrf @method('PUT')
            <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $setting->badge_text) }}" placeholder="Legacy & Vision"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Utama <span class="text-red-400">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $setting->title) }}" placeholder="Membangun Masa Depan"
                               class="w-full px-3.5 py-2.5 border @error('title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                        <input type="text" name="highlighted_title" value="{{ old('highlighted_title', $setting->highlighted_title) }}" placeholder="Bersama Kami."
                               class="w-full px-3.5 py-2.5 border @error('highlighted_title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        @error('highlighted_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Hero <span class="text-red-400">*</span></label>
                        <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 border @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $setting->description) }}</textarea>
                        @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Hero / About</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition zone-box" id="about-drop-zone">
                        <div id="about-preview-wrap" class="{{ $setting->hero_image ? '' : 'hidden' }} mb-4">
                            <img id="about-preview-img" src="{{ $setting->hero_image ? asset('storage/'.$setting->hero_image) : '' }}" alt="Preview" class="mx-auto max-h-48 rounded-xl object-cover shadow">
                            <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
                        </div>
                        <div id="about-placeholder" class="{{ $setting->hero_image ? 'hidden' : '' }}">
                            <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-400">Klik atau drag & drop gambar</p>
                        </div>
                        <input type="file" name="hero_image" id="hero_image" accept="image/*" class="hidden"
                               onchange="previewImage(this,'about-preview-img','about-preview-wrap','about-placeholder')">
                        <button type="button" onclick="document.getElementById('hero_image').click()"
                                class="mt-3 px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                            {{ $setting->hero_image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                        </button>
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP</p>
                        @error('hero_image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- VISI MISI --}}
            <div class="px-6 pb-4">
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <span class="text-lg">🎯</span> Visi & Misi
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-blue-50 rounded-2xl p-5 space-y-3">
                            <p class="text-sm font-bold text-blue-700 flex items-center gap-2">👁 Visi</p>
                            <div>
                                <label class="block text-xs font-semibold text-blue-600 mb-1.5">Judul Visi <span class="text-red-400">*</span></label>
                                <input type="text" name="vision_title" value="{{ old('vision_title', $setting->vision_title) }}" placeholder="Menjadi Rumah Inovasi."
                                       class="w-full px-3 py-2.5 bg-white border border-blue-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
                                @error('vision_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-blue-600 mb-1.5">Deskripsi Visi <span class="text-red-400">*</span></label>
                                <textarea name="vision_description" rows="4" class="w-full px-3 py-2.5 bg-white border border-blue-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 transition resize-none">{{ old('vision_description', $setting->vision_description) }}</textarea>
                                @error('vision_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="bg-yellow-50 rounded-2xl p-5 space-y-3">
                            <p class="text-sm font-bold text-yellow-700 flex items-center gap-2">🎯 Misi</p>
                            <div>
                                <label class="block text-xs font-semibold text-yellow-700 mb-1.5">Judul Misi <span class="text-red-400">*</span></label>
                                <input type="text" name="mission_title" value="{{ old('mission_title', $setting->mission_title) }}" placeholder="Membangun Nilai Nyata."
                                       class="w-full px-3 py-2.5 bg-white border border-yellow-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-yellow-200 transition">
                                @error('mission_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-yellow-700 mb-1.5">Deskripsi Misi <span class="text-red-400">*</span></label>
                                <textarea name="mission_description" rows="4" class="w-full px-3 py-2.5 bg-white border border-yellow-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-yellow-200 transition resize-none">{{ old('mission_description', $setting->mission_description) }}</textarea>
                                @error('mission_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 pb-5 flex justify-end gap-3">
                <a href="{{ route('about') }}" target="_blank" class="px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                <button type="submit" id="setting-submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Semua
                </button>
            </div>
        </form>
    </div>

    {{-- ============ SECTION 2: KISAH KAMI ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="story">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-yellow-50 to-white">
            <div class="w-8 h-8 bg-yellow-100 text-yellow-700 rounded-lg flex items-center justify-center text-sm">📖</div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Kisah Kami Section</h2>
                <p class="text-xs text-gray-400">Pengaturan konten cerita sejarah/kisah kami berawal</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.tentang.story.update') }}" enctype="multipart/form-data" id="story-form">
            @csrf @method('PUT')
            <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Line 1 <span class="text-red-400">*</span></label>
                            <input type="text" name="story_title_line_1" value="{{ old('story_title_line_1', $setting->story_title_line_1) }}" required
                                   placeholder="Kisah Kami Berawal Dari"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            @error('story_title_line_1')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                            <input type="text" name="story_title_highlight" value="{{ old('story_title_highlight', $setting->story_title_highlight) }}" required
                                   placeholder="Satu Misi."
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition text-brand-blue font-semibold">
                            @error('story_title_highlight')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Cerita <span class="text-red-400">*</span></label>
                        <textarea name="story_description" rows="3" required placeholder="Didirikan dengan kepedulian mendalam..."
                                  class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('story_description', $setting->story_description) }}</textarea>
                        @error('story_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Quote Cerita <span class="text-red-400">*</span></label>
                        <textarea name="story_quote" rows="2" required placeholder="Setiap anak adalah bintang..."
                                  class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none font-semibold text-brand-dark bg-gray-50">{{ old('story_quote', $setting->story_quote) }}</textarea>
                        @error('story_quote')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Paragraf Tambahan <span class="text-red-400">*</span></label>
                        <textarea name="story_bottom_text" rows="3" required placeholder="Kami percaya bahwa pendidikan..."
                                  class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('story_bottom_text', $setting->story_bottom_text) }}</textarea>
                        @error('story_bottom_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Kisah Kami</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition" id="story-drop-zone">
                        <div id="story-preview-wrap" class="{{ $setting->story_image ? '' : 'hidden' }} mb-4">
                            <img id="story-preview-img" src="{{ $setting->story_image ? asset('storage/'.$setting->story_image) : '' }}" alt="Preview" class="mx-auto max-h-48 rounded-xl object-cover shadow">
                            <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
                        </div>
                        <div id="story-placeholder" class="{{ $setting->story_image ? 'hidden' : '' }}">
                            <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-400">Klik atau drag & drop gambar</p>
                        </div>
                        <input type="file" name="story_image" id="story_image" accept="image/*" class="hidden"
                               onchange="previewImage(this,'story-preview-img','story-preview-wrap','story-placeholder')">
                        <button type="button" onclick="document.getElementById('story_image').click()"
                                class="mt-3 px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                            {{ $setting->story_image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                        </button>
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP</p>
                        @error('story_image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
            <div class="px-6 pb-5 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Kisah Kami
                </button>
            </div>
        </form>
    </div>

    {{-- ============ SECTION 3: PROBLEM VS SOLUTION ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="problem-solution">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-red-50 to-white">
            <div class="w-8 h-8 bg-red-100 text-red-700 rounded-lg flex items-center justify-center text-sm">⚖️</div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Problem vs Solution Section</h2>
                <p class="text-xs text-gray-400">Kelola judul & isi perbandingan kekhawatiran orangtua dan solusi bimbingan</p>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Form judul/setelan --}}
            <form method="POST" action="{{ route('admin.tentang.problem-solution.update') }}" class="space-y-4">
                @csrf @method('PUT')
                <div class="flex items-center justify-between pb-2 border-b border-gray-50">
                    <h3 class="text-xs font-bold text-gray-700 uppercase">Setelan Judul & Label</h3>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="ps-is-active" value="1"
                               {{ $probSolSetting->is_active ? 'checked' : '' }}
                               class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500">
                        <label for="ps-is-active" class="text-xs font-semibold text-gray-600">Aktifkan Section</label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Label Kecil <span class="text-red-400">*</span></label>
                    <input type="text" name="small_label" value="{{ old('small_label', $probSolSetting->small_label) }}" required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Utama <span class="text-red-400">*</span></label>
                        <input type="text" name="main_title" value="{{ old('main_title', $probSolSetting->main_title) }}" required
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                        <input type="text" name="main_title_highlight" value="{{ old('main_title_highlight', $probSolSetting->main_title_highlight) }}" required
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition text-brand-blue font-semibold">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Problem (Kiri) <span class="text-red-400">*</span></label>
                        <input type="text" name="problem_title" value="{{ old('problem_title', $probSolSetting->problem_title) }}" required
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition text-red-600">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Solusi (Kanan) <span class="text-red-400">*</span></label>
                        <input type="text" name="solution_title" value="{{ old('solution_title', $probSolSetting->solution_title) }}" required
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition text-brand-blue font-semibold">
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Judul Solusi
                    </button>
                </div>
            </form>

            {{-- List items problem & solution --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-gray-50">
                    <h3 class="text-xs font-bold text-gray-700 uppercase">Daftar Poin Masalah & Solusi</h3>
                    <button onclick="toggleModal('modal-tambah-item')"
                            class="px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Item
                    </button>
                </div>

                <div class="overflow-x-auto max-h-[380px] overflow-y-auto border border-gray-100 rounded-xl">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-500 uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-4 py-2.5">Tipe</th>
                                <th class="px-4 py-2.5">Teks Item</th>
                                <th class="px-4 py-2.5 text-center">Urutan</th>
                                <th class="px-4 py-2.5 text-center">Status</th>
                                <th class="px-4 py-2.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($probSolItems as $item)
                            <tr class="hover:bg-gray-50 transition {{ $item->is_active ? '' : 'opacity-50' }}">
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase
                                                 {{ $item->type === 'problem' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $item->type }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $item->text }}</td>
                                <td class="px-4 py-3 text-center font-bold text-gray-500">{{ $item->sort_order }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.tentang.problem-solution-item.toggle', $item) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-2 py-0.5 rounded-full text-[10px] font-semibold transition {{ $item->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button type="button" onclick="openEditItemModal({{ $item->id }}, '{{ $item->type }}', '{{ addslashes($item->text) }}', {{ $item->sort_order }}, {{ $item->is_active ? 1 : 0 }})"
                                                class="p-1.5 text-brand-600 hover:bg-brand-50 rounded transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form method="POST" action="{{ route('admin.tentang.problem-solution-item.destroy', $item) }}" onsubmit="return confirm('Hapus item ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">Belum ada item list.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ SECTION 4: STATISTICS ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="statistics">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-purple-100 text-purple-700 rounded-lg flex items-center justify-center text-sm">📊</div>
                <div>
                    <h2 class="font-semibold text-gray-800 text-sm">Statistik / Siswa Aktif</h2>
                    <p class="text-xs text-gray-400">Pencapaian numerik di halaman Tentang Kami (e.g., 100+ Siswa Aktif)</p>
                </div>
            </div>
            <button onclick="toggleModal('modal-tambah-stat')"
                    class="px-3.5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Statistik
            </button>
        </div>

        <div class="overflow-x-auto">
            @if($statistics->isEmpty())
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">📊</div>
                    <p class="text-sm font-medium">Belum ada data statistik</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Angka / Persentase</th>
                            <th class="px-6 py-3 text-left">Label Keterangan</th>
                            <th class="px-6 py-3 text-center">Urutan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($statistics as $stat)
                        <tr class="hover:bg-gray-50 transition {{ $stat->is_active ? '' : 'opacity-50' }}">
                            <td class="px-6 py-4 font-black text-gray-850 text-base italic">{{ $stat->number }}</td>
                            <td class="px-6 py-4 font-medium text-gray-600">{{ $stat->label }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 bg-gray-100 rounded-lg text-xs font-bold text-gray-600">{{ $stat->sort_order }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.tentang.statistic.toggle', $stat) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold {{ $stat->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $stat->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="openEditStatModal({{ $stat->id }}, '{{ addslashes($stat->number) }}', '{{ addslashes($stat->label) }}', {{ $stat->sort_order }}, {{ $stat->is_active ? 1 : 0 }})"
                                            class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.tentang.statistic.destroy', $stat) }}" onsubmit="return confirm('Hapus statistik ini?')">
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

</div>

{{-- ============ MODAL TAMBAH PROBLEM/SOLUTION ITEM ============ --}}
<div id="modal-tambah-item" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-tambah-item')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Item Baru</h3>
            <button type="button" onclick="toggleModal('modal-tambah-item')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.tentang.problem-solution-item.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tipe Item <span class="text-red-400">*</span></label>
                <select name="type" required class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    <option value="problem">Problem (Kekhawatiran Umum)</option>
                    <option value="solution">Solution (Solusi Kami)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Item <span class="text-red-400">*</span></label>
                <input type="text" name="text" required placeholder="Contoh: Belajar santai tanpa beban"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                <input type="number" name="sort_order" min="0" value="1"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="item-is-active" value="1" checked
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="item-is-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-tambah-item')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan Item</button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL EDIT PROBLEM/SOLUTION ITEM ============ --}}
<div id="modal-edit-item" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-edit-item')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Edit Item</h3>
            <button type="button" onclick="toggleModal('modal-edit-item')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="form-edit-item" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tipe Item <span class="text-red-400">*</span></label>
                <select name="type" id="edit-item-type" required class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    <option value="problem">Problem (Kekhawatiran Umum)</option>
                    <option value="solution">Solution (Solusi Kami)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Item <span class="text-red-400">*</span></label>
                <input type="text" name="text" id="edit-item-text" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                <input type="number" name="sort_order" id="edit-item-order" min="0"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="edit-item-is-active" value="1"
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="edit-item-is-active" class="text-sm text-gray-600">Aktif (Tampil di website)</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-edit-item')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL TAMBAH STATISTIK ============ --}}
<div id="modal-tambah-stat" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-tambah-stat')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Statistik Baru</h3>
            <button type="button" onclick="toggleModal('modal-tambah-stat')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.tentang.statistic.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Angka / Nilai <span class="text-red-400">*</span></label>
                <input type="text" name="number" required placeholder="Contoh: 100+ atau 98%"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Label Keterangan <span class="text-red-400">*</span></label>
                <input type="text" name="label" required placeholder="Contoh: Siswa Aktif"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                <input type="number" name="sort_order" min="0" value="{{ $statistics->count() + 1 }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="stat-is-active" value="1" checked
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="stat-is-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-tambah-stat')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan Statistik</button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL EDIT STATISTIK ============ --}}
<div id="modal-edit-stat" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-edit-stat')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Edit Statistik</h3>
            <button type="button" onclick="toggleModal('modal-edit-stat')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="form-edit-stat" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Angka / Nilai <span class="text-red-400">*</span></label>
                <input type="text" name="number" id="edit-stat-number" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Label Keterangan <span class="text-red-400">*</span></label>
                <input type="text" name="label" id="edit-stat-label" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                <input type="number" name="sort_order" id="edit-stat-order" min="0"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="edit-stat-is-active" value="1"
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="edit-stat-is-active" class="text-sm text-gray-600">Aktif (Tampil di website)</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-edit-stat')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan Perubahan</button>
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

// Open modal edit problem/solution item & populate fields
function openEditItemModal(id, type, text, sortOrder, isActive) {
    const form = document.getElementById('form-edit-item');
    form.action = `/admin/tentang/problem-solution-item/${id}`;
    
    document.getElementById('edit-item-type').value = type;
    document.getElementById('edit-item-text').value = text;
    document.getElementById('edit-item-order').value = sortOrder;
    document.getElementById('edit-item-is-active').checked = isActive === 1;
    
    toggleModal('modal-edit-item');
}

// Open modal edit statistic & populate fields
function openEditStatModal(id, number, label, sortOrder, isActive) {
    const form = document.getElementById('form-edit-stat');
    form.action = `/admin/tentang/statistic/${id}`;
    
    document.getElementById('edit-stat-number').value = number;
    document.getElementById('edit-stat-label').value = label;
    document.getElementById('edit-stat-order').value = sortOrder;
    document.getElementById('edit-stat-is-active').checked = isActive === 1;
    
    toggleModal('modal-edit-stat');
}

// Loading state pada submit Hero/Visi/Misi Form
document.getElementById('setting-form').addEventListener('submit', function() {
    const btn = document.getElementById('setting-submit');
    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`;
});

// Drag & drop gambar Hero
const aboutDropZone = document.getElementById('about-drop-zone');
if (aboutDropZone) {
    aboutDropZone.addEventListener('dragover', e => { e.preventDefault(); aboutDropZone.classList.add('border-brand-400', 'bg-brand-50'); });
    aboutDropZone.addEventListener('dragleave', () => aboutDropZone.classList.remove('border-brand-400', 'bg-brand-50'));
    aboutDropZone.addEventListener('drop', e => {
        e.preventDefault();
        aboutDropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('hero_image').files = dt.files;
            previewImage(document.getElementById('hero_image'), 'about-preview-img', 'about-preview-wrap', 'about-placeholder');
        }
    });
}

// Drag & drop gambar Kisah Kami (Story)
const storyDropZone = document.getElementById('story-drop-zone');
if (storyDropZone) {
    storyDropZone.addEventListener('dragover', e => { e.preventDefault(); storyDropZone.classList.add('border-brand-400', 'bg-brand-50'); });
    storyDropZone.addEventListener('dragleave', () => storyDropZone.classList.remove('border-brand-400', 'bg-brand-50'));
    storyDropZone.addEventListener('drop', e => {
        e.preventDefault();
        storyDropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('story_image').files = dt.files;
            previewImage(document.getElementById('story_image'), 'story-preview-img', 'story-preview-wrap', 'story-placeholder');
        }
    });
}
</script>
@endpush
