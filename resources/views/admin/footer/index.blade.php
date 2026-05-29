@extends('admin.layouts.app')
@section('title', 'Footer')
@section('page-title', 'Setting Footer')
@section('breadcrumb', 'Kelola konten footer website')

@section('content')
<div class="max-w-3xl space-y-6">

{{-- ===== FORM FOOTER ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white flex items-center gap-3">
        <div class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center text-sm">🦶</div>
        <h2 class="font-semibold text-gray-800">Konten Footer</h2>
    </div>
    <form method="POST" action="{{ route('admin.footer.update') }}" enctype="multipart/form-data" class="p-6 space-y-5">
        @csrf



        {{-- Brand & Copyright --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Brand</label>
                <input type="text" name="brand_name" value="{{ old('brand_name', $footer->brand_name ?? 'Ruang Belajar') }}"
                       placeholder="Ruang Belajar"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Copyright</label>
                <input type="text" name="copyright_text" value="{{ old('copyright_text', $footer->copyright_text ?? '© ' . date('Y') . ' Ruang Belajar.') }}"
                       placeholder="© 2025 Ruang Belajar. All rights reserved."
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Footer</label>
            <textarea name="footer_description" rows="3" placeholder="Bimbingan belajar modern untuk melahirkan pribadi cerdas..."
                      class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('footer_description', $footer->footer_description ?? $footer->description ?? '') }}</textarea>
        </div>

        {{-- Kontak Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $footer->email ?? '') }}"
                       placeholder="halo@ruangbelajar.com"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">No. Telepon / WA</label>
                <input type="text" name="phone" value="{{ old('phone', $footer->phone ?? '') }}"
                       placeholder="0831-5711-2597"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Alamat</label>
            <textarea name="address" rows="2" placeholder="Tajur, Bogor Selatan, Kota Bogor, Jawa Barat"
                      class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('address', $footer->address ?? '') }}</textarea>
        </div>

        {{-- CTA Footer --}}
        <div class="border-t border-gray-100 pt-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">📣 CTA Footer (Opsional)</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul CTA</label>
                    <input type="text" name="footer_cta_title" value="{{ old('footer_cta_title', $footer->footer_cta_title ?? '') }}"
                           placeholder="Siap Mulai Perjalanan Belajar?"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Subtitle CTA</label>
                    <input type="text" name="footer_cta_subtitle" value="{{ old('footer_cta_subtitle', $footer->footer_cta_subtitle ?? '') }}"
                           placeholder="Konsultasi gratis sekarang."
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Tombol CTA</label>
                    <input type="text" name="footer_cta_button_text" value="{{ old('footer_cta_button_text', $footer->footer_cta_button_text ?? 'Daftar Sekarang') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">URL Tombol CTA</label>
                    <input type="url" name="footer_cta_button_url" value="{{ old('footer_cta_button_url', $footer->footer_cta_button_url ?? '') }}"
                           placeholder="https://wa.me/..."
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Footer
            </button>
        </div>
    </form>
</div>

{{-- Social Media Preview --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-800 text-sm flex items-center gap-2">
            <span class="w-6 h-6 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-xs">📲</span>
            Sosial Media Aktif
        </h3>
        <a href="{{ route('admin.sosmed.index') }}" class="text-xs text-brand-600 hover:underline">Kelola →</a>
    </div>
    @if($socialMedia->isEmpty())
        <p class="text-xs text-gray-400 text-center py-4">Belum ada sosial media. <a href="{{ route('admin.sosmed.index') }}" class="text-brand-600">Tambah sekarang</a>.</p>
    @else
        <div class="flex flex-wrap gap-2">
            @foreach($socialMedia as $sm)
            <a href="{{ $sm->url }}" target="_blank"
               class="flex items-center gap-2 px-3 py-1.5 {{ $sm->is_active ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-400' }} rounded-full text-xs font-semibold transition">
                <i class="{{ $sm->auto_icon }}"></i> {{ $sm->platform }}
                @if($sm->username)<span class="opacity-60">{{ $sm->username }}</span>@endif
                @if(!$sm->is_active)<span class="text-[9px] bg-red-100 text-red-500 px-1.5 py-0.5 rounded-full">OFF</span>@endif
            </a>
            @endforeach
        </div>
    @endif
</div>

</div>
@endsection
