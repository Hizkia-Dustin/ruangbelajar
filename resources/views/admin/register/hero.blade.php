@extends('admin.layouts.app')
@section('title', 'Setting Halaman Daftar')
@section('page-title', 'Setting Halaman Daftar')
@section('breadcrumb', 'Kelola semua teks hero dan form halaman pendaftaran')

@section('content')
<form method="POST" action="{{ route('admin.register.hero.update') }}" class="space-y-8 max-w-5xl">
    @csrf
    @method('PUT')

    {{-- ============ SEKSI 1: HERO & TEKS KIRI ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="hero-kiri">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center text-sm">
                📢
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Teks Utama & Hero (Kiri)</h2>
                <p class="text-xs text-gray-400">Atur badge kecil, judul besar, deskripsi, benefit, dan counter social proof</p>
            </div>
        </div>

        <div class="p-6 space-y-6">
            {{-- Badge & Judul --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge Text</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}"
                           placeholder="Contoh: PENDAFTARAN DIBUKA"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('badge_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Baris 1 <span class="text-red-400">*</span></label>
                    <input type="text" name="title_line_1" value="{{ old('title_line_1', $hero->title_line_1) }}"
                           placeholder="Contoh: Mulai Perjalanan Belajar" required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('title_line_1')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Baris 2 <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="title_line_2" value="{{ old('title_line_2', $hero->title_line_2) }}"
                           placeholder="Contoh: Bersama Tutor Berpengalaman"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('title_line_2')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                    <input type="text" name="title_highlight" value="{{ old('title_highlight', $hero->title_highlight) }}"
                           placeholder="Contoh: Yang Menyenangkan." required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('title_highlight')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Singkat</label>
                <textarea name="description" rows="3" placeholder="Tulis deskripsi di sini..."
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $hero->description) }}</textarea>
                @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <hr class="border-gray-100">

            {{-- Benefit / Keunggulan --}}
            <div class="space-y-3">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Checklist Benefit (Maksimal 3)</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Benefit 1 --}}
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                        <span class="inline-block px-2.5 py-0.5 bg-brand-100 text-brand-700 text-[9px] font-black uppercase rounded-full">Benefit 1</span>
                        <div>
                            <input type="text" name="benefit_1_title" value="{{ old('benefit_1_title', $hero->benefit_1_title) }}"
                                   placeholder="Judul: Kelas Super Kecil"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        </div>
                        <div>
                            <textarea name="benefit_1_description" rows="2" placeholder="Maksimal 5 anak per sesi."
                                      class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white resize-none">{{ old('benefit_1_description', $hero->benefit_1_description) }}</textarea>
                        </div>
                    </div>
                    {{-- Benefit 2 --}}
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                        <span class="inline-block px-2.5 py-0.5 bg-brand-100 text-brand-700 text-[9px] font-black uppercase rounded-full">Benefit 2</span>
                        <div>
                            <input type="text" name="benefit_2_title" value="{{ old('benefit_2_title', $hero->benefit_2_title) }}"
                                   placeholder="Judul: Metode Playful"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        </div>
                        <div>
                            <textarea name="benefit_2_description" rows="2" placeholder="Belajar asik tanpa tekanan."
                                      class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white resize-none">{{ old('benefit_2_description', $hero->benefit_2_description) }}</textarea>
                        </div>
                    </div>
                    {{-- Benefit 3 --}}
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                        <span class="inline-block px-2.5 py-0.5 bg-brand-100 text-brand-700 text-[9px] font-black uppercase rounded-full">Benefit 3</span>
                        <div>
                            <input type="text" name="benefit_3_title" value="{{ old('benefit_3_title', $hero->benefit_3_title) }}"
                                   placeholder="Judul: Konsultasi Gratis"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        </div>
                        <div>
                            <textarea name="benefit_3_description" rows="2" placeholder="Bantu pilihkan program terbaik."
                                      class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white resize-none">{{ old('benefit_3_description', $hero->benefit_3_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Counter Social Proof --}}
            <div class="space-y-3">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Counter / Social Proof (Kiri Bawah)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Angka Counter</label>
                        <input type="text" name="counter_text" value="{{ old('counter_text', $hero->counter_text) }}"
                               placeholder="Contoh: 100+ Anak"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 bg-white">
                        @error('counter_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Deskripsi Counter</label>
                        <input type="text" name="counter_description" value="{{ old('counter_description', $hero->counter_description) }}"
                               placeholder="Contoh: Telah Bergabung Bersama Kami"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 bg-white">
                        @error('counter_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ SEKSI 2: FORMULIR & LABEL KANAN ============ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="form-kanan">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center text-sm">
                📋
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Teks & Label Formulir (Kanan)</h2>
                <p class="text-xs text-gray-400">Atur judul form, label, placeholder, nama tombol, dan teks keamanan data</p>
            </div>
        </div>

        <div class="p-6 space-y-6">
            {{-- Judul Form --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Form (Line 1) <span class="text-red-400">*</span></label>
                    <input type="text" name="form_title" value="{{ old('form_title', $formSetting->form_title ?? 'Isi Data') }}"
                           placeholder="Contoh: Isi Data" required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    @error('form_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Form Highlight <span class="text-red-400">*</span></label>
                    <input type="text" name="form_highlight" value="{{ old('form_highlight', $formSetting->form_highlight ?? 'Pendaftaran.') }}"
                           placeholder="Contoh: Pendaftaran." required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    @error('form_highlight')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Fields Label & Placeholders --}}
            <div class="space-y-4">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Pengaturan Label & Placeholder Input</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    {{-- Nama Anak --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Nama Lengkap Anak</label>
                        <input type="text" name="label_child_name" value="{{ old('label_child_name', $formSetting->label_child_name ?? 'Nama Lengkap Anak') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_child_name" value="{{ old('placeholder_child_name', $formSetting->placeholder_child_name ?? 'Masukkan nama putra/putri Anda') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- Nama Orang Tua --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Nama Orang Tua / Wali</label>
                        <input type="text" name="label_parent_name" value="{{ old('label_parent_name', $formSetting->label_parent_name ?? 'Nama Orang Tua / Wali') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_parent_name" value="{{ old('placeholder_parent_name', $formSetting->placeholder_parent_name ?? 'Masukkan nama Ibu / Ayah / Wali') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- Umur Anak --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Umur Anak</label>
                        <input type="text" name="label_age" value="{{ old('label_age', $formSetting->label_age ?? 'Umur Anak') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_age" value="{{ old('placeholder_age', $formSetting->placeholder_age ?? 'Contoh: 5') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- Kelas --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Kelas</label>
                        <input type="text" name="label_class" value="{{ old('label_class', $formSetting->label_class ?? 'Kelas') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_class" value="{{ old('placeholder_class', $formSetting->placeholder_class ?? 'Contoh: TK-B atau 1 SD') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- Program --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Pilih Program</label>
                        <input type="text" name="label_program" value="{{ old('label_program', $formSetting->label_program ?? 'Pilih Program Belajar') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_program" value="{{ old('placeholder_program', $formSetting->placeholder_program ?? '-- Pilih Program --') }}"
                               placeholder="Placeholder (Default option)" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- No WA --}}
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Nomor WhatsApp Aktif</label>
                        <input type="text" name="label_whatsapp" value="{{ old('label_whatsapp', $formSetting->label_whatsapp ?? 'Nomor WhatsApp Aktif') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_whatsapp" value="{{ old('placeholder_whatsapp', $formSetting->placeholder_whatsapp ?? 'Contoh: 0812xxxxxx') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                    {{-- Catatan --}}
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Input: Catatan Tambahan</label>
                        <input type="text" name="label_note" value="{{ old('label_note', $formSetting->label_note ?? 'Catatan / Keterangan Tambahan') }}"
                               placeholder="Label" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                        <input type="text" name="placeholder_note" value="{{ old('placeholder_note', $formSetting->placeholder_note ?? 'Tuliskan catatan tambahan jika ada...') }}"
                               placeholder="Placeholder" class="w-full px-3 py-2 border rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white text-slate-400">
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Tombol & Trust Badges --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Tombol Submit <span class="text-red-400">*</span></label>
                    <input type="text" name="button_text" value="{{ old('button_text', $formSetting->button_text ?? 'Daftar Sekarang') }}"
                           placeholder="Contoh: DAFTAR SEKARANG" required
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    @error('button_text')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-600">Teks Trust Keamanan Data (Bawah Tombol)</label>
                    <input type="text" name="trust_text_1" value="{{ old('trust_text_1', $formSetting->trust_text_1 ?? 'Data Aman Terlindungi') }}"
                           placeholder="Trust Label 1 (Contoh: Data Aman Terlindungi)"
                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                    <input type="text" name="trust_text_2" value="{{ old('trust_text_2', $formSetting->trust_text_2 ?? 'Respon Cepat Kilat') }}"
                           placeholder="Trust Label 2 (Contoh: Respon Cepat Kilat)"
                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-brand-500 bg-white">
                </div>
            </div>
        </div>
    </div>

    {{-- Button Submit Utama --}}
    <div class="flex justify-end pt-2">
        <button type="submit" class="px-8 py-3 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2 shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Semua Pengaturan
        </button>
    </div>
</form>
@endsection
