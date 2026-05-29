{{-- Partial form: dipakai di create.blade.php dan edit.blade.php --}}

<div class="p-6 space-y-5">

    {{-- Row 1: Judul & Badge --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Program <span class="text-red-400">*</span></label>
            <input type="text" name="title" value="{{ old('title', $program?->display_title) }}" required
                   placeholder="Bimbel Pra-TK"
                   class="w-full px-3.5 py-2.5 border @error('title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge <span class="text-gray-400 font-normal">(opsional)</span></label>
            <input type="text" name="badge_text" value="{{ old('badge_text', $program?->badge_text) }}"
                   placeholder="Program Unggulan"
                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
        </div>
    </div>

    {{-- Row 2: Rentang Usia --}}
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Rentang Usia <span class="text-gray-400 font-normal">(opsional)</span></label>
        <input type="text" name="age_range" value="{{ old('age_range', $program?->display_age_range) }}"
               placeholder="Usia 2–4 Tahun"
               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
    </div>

    {{-- Row 3: Deskripsi Lengkap --}}
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Lengkap <span class="text-red-400">*</span></label>
        <textarea name="description" rows="4" required
                  placeholder="Deskripsi lengkap program..."
                  class="w-full px-3.5 py-2.5 border @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $program?->deskripsi ?? $program?->description) }}</textarea>
        @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
    </div>

    {{-- Row 5: Tombol CTA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Tombol</label>
            <input type="text" name="button_text" value="{{ old('button_text', $program?->button_text ?? 'Tanya Program Ini') }}"
                   placeholder="Tanya Program Ini"
                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Link Tombol</label>
            <input type="text" name="button_link" value="{{ old('button_link', $program?->button_link ?? 'https://wa.me/6283157112597') }}"
                   placeholder="https://wa.me/..."
                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
        </div>
    </div>

    {{-- Row 6: Urutan & Status --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $program?->sort_order ?: $program?->urutan ?? 0) }}" min="0"
                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            @error('sort_order')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Status</label>
            <select name="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                <option value="active" {{ old('status', $program?->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="draft" {{ old('status', $program?->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="inactive" {{ old('status', $program?->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="flex flex-col gap-3 pt-5">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $program?->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <span class="text-sm text-gray-600">Tampilkan</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $program?->is_featured) ? 'checked' : '' }}
                       class="w-4 h-4 text-yellow-500 border-gray-300 rounded">
                <span class="text-sm text-gray-600">⭐ Program Unggulan</span>
            </label>
        </div>
    </div>

    {{-- Row 7: Upload Thumbnail --}}
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Thumbnail Program</label>
        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 hover:border-brand-400 transition" id="thumb-drop-zone">
            @php $currentImg = $program?->thumbnail ?: $program?->image; @endphp
            <div id="thumb-preview-wrap" class="{{ $currentImg ? '' : 'hidden' }} mb-3 text-center">
                <img id="thumb-preview-img" src="{{ $currentImg ? asset('storage/'.$currentImg) : '' }}"
                     alt="Preview" class="mx-auto max-h-40 rounded-xl object-cover shadow inline-block">
                <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
            </div>
            <div id="thumb-placeholder" class="{{ $currentImg ? 'hidden' : '' }} text-center py-4">
                <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm text-gray-400">Drag & drop atau klik pilih gambar</p>
            </div>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                   onchange="previewThumb(this)">
            <div class="text-center mt-2">
                <button type="button" onclick="document.getElementById('thumbnail').click()"
                        class="px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                    {{ $currentImg ? 'Ganti Gambar' : 'Pilih Gambar' }}
                </button>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP — maks. 2MB</p>
            </div>
            @error('thumbnail')<p class="mt-1 text-xs text-red-500 text-center">{{ $message }}</p>@enderror
        </div>
    </div>

</div>

{{-- Form Actions --}}
<div class="px-6 pb-5 flex justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.programs.index') }}"
       class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">← Kembali</a>
    <button type="submit" id="prog-submit"
            class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ $program ? 'Simpan Perubahan' : 'Tambah Program' }}
    </button>
</div>

@push('scripts')
<script>
function previewThumb(input) {
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => {
            document.getElementById('thumb-preview-img').src = e.target.result;
            document.getElementById('thumb-preview-wrap').classList.remove('hidden');
            document.getElementById('thumb-placeholder').classList.add('hidden');
        };
        r.readAsDataURL(input.files[0]);
    }
}
document.getElementById('program-form')?.addEventListener('submit', function() {
    const btn = document.getElementById('prog-submit');
    if (btn) { btn.disabled = true; btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`; }
});
const dz = document.getElementById('thumb-drop-zone');
if (dz) {
    dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('border-brand-400','bg-brand-50'); });
    dz.addEventListener('dragleave', () => dz.classList.remove('border-brand-400','bg-brand-50'));
    dz.addEventListener('drop', e => {
        e.preventDefault(); dz.classList.remove('border-brand-400','bg-brand-50');
        const f = e.dataTransfer.files[0];
        if (f && f.type.startsWith('image/')) { const dt = new DataTransfer(); dt.items.add(f); document.getElementById('thumbnail').files = dt.files; previewThumb(document.getElementById('thumbnail')); }
    });
}
</script>
@endpush
