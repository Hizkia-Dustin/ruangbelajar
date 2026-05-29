<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Side: Text Inputs --}}
    <div class="lg:col-span-2 space-y-6">
        <div>
            <label for="name" class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Orang Tua / Wali Murid <span class="text-red-400">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name ?? '') }}"
                   placeholder="Masukkan nama orang tua / wali murid..." required
                   class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="role" class="block text-xs font-semibold text-gray-600 mb-1.5">Role / Status <span class="text-red-400">*</span></label>
            <input type="text" name="role" id="role" value="{{ old('role', $testimonial->role ?? '') }}"
                   placeholder="Contoh: Wali Murid TK / Orang Tua Siswa..." required
                   class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('role') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            @error('role')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="testimonial" class="block text-xs font-semibold text-gray-600 mb-1.5">Isi Testimoni <span class="text-red-400">*</span></label>
            <textarea name="testimonial" id="testimonial" rows="6" required
                      placeholder="Tuliskan pengalaman positif atau ulasan dari orang tua murid di sini..."
                      class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('testimonial') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>
            @error('testimonial')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="rating" class="block text-xs font-semibold text-gray-600 mb-1.5">Rating Bintang <span class="text-red-400">*</span></label>
                <select name="rating" id="rating" required
                        class="w-full px-3.5 py-2.5 border rounded-xl text-sm @error('rating') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <option value="">-- Pilih Rating Bintang --</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? '') == $i ? 'selected' : '' }}>
                            @for($j = 1; $j <= $i; $j++)★@endfor ({{ $i }} Bintang)
                        </option>
                    @endfor
                </select>
                @error('rating')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-2">Lokasi Tampilan</label>
                <div class="flex flex-col gap-2 mt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="tampil_di_beranda" value="0">
                        <input type="checkbox" name="tampil_di_beranda" id="tampil_di_beranda" value="1"
                               {{ old('tampil_di_beranda', $testimonial->tampil_di_beranda ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500">
                        <span class="text-sm text-gray-600">Tampilkan di Beranda</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="tampil_di_tentang" value="0">
                        <input type="checkbox" name="tampil_di_tentang" id="tampil_di_tentang" value="1"
                               {{ old('tampil_di_tentang', $testimonial->tampil_di_tentang ?? false) ? 'checked' : '' }}
                               class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500">
                        <span class="text-sm text-gray-600">Tampilkan di Tentang Kami</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Side: Settings & Upload Image --}}
    <div class="space-y-6">
        {{-- Foto Upload --}}
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Foto Orang Tua <span class="text-gray-400 font-normal">(opsional)</span></label>
            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition-colors" id="photo-drop-zone">
                {{-- Preview --}}
                <div id="photo-preview-wrap" class="{{ isset($testimonial) && $testimonial->photo ? '' : 'hidden' }} mb-4">
                    <img id="photo-preview-img"
                         src="{{ isset($testimonial) && $testimonial->photo ? asset('storage/'.$testimonial->photo) : '' }}"
                         alt="Preview" class="mx-auto max-h-40 w-40 rounded-2xl object-cover shadow border border-gray-100">
                    <p class="text-[10px] text-gray-400 mt-2">Foto saat ini</p>
                </div>
                <div id="photo-placeholder" class="{{ isset($testimonial) && $testimonial->photo ? 'hidden' : '' }}">
                    <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-xs text-gray-400">Klik atau drag & drop foto ke sini</p>
                </div>
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="hidden" onchange="previewImage(this, 'photo-preview-img', 'photo-preview-wrap', 'photo-placeholder')">
                <button type="button" onclick="document.getElementById('photo').click()"
                        class="mt-3 px-4 py-2 text-xs font-semibold text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-xl transition">
                    {{ isset($testimonial) && $testimonial->photo ? 'Ganti Foto' : 'Pilih Foto' }}
                </button>
                <p class="text-[10px] text-gray-400 mt-2">JPG, PNG, WebP — maks. 2MB</p>
                @error('photo')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Urutan & Toggles --}}
        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 space-y-4">
            <div>
                <label for="sort_order" class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan Tampil</label>
                <input type="number" name="sort_order" id="sort_order" min="0"
                       value="{{ old('sort_order', $testimonial->sort_order ?? '0') }}"
                       class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                <p class="text-[10px] text-gray-400 mt-1">Mengatur prioritas tampil (angka lebih kecil tampil lebih dulu).</p>
                @error('sort_order')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <hr class="border-gray-200/60 my-2">

            <div class="flex items-center justify-between">
                <div>
                    <label for="is_featured" class="text-sm font-semibold text-gray-700">Testimoni Unggulan (Featured)</label>
                    <p class="text-[10px] text-gray-400">Tampil prioritas utama di bagian paling atas.</p>
                </div>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}
                           class="w-4.5 h-4.5 text-brand-600 border-gray-300 rounded focus:ring-brand-500 focus:ring-2">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <label for="is_active" class="text-sm font-semibold text-gray-700">Status Aktif</label>
                    <p class="text-[10px] text-gray-400">Tampilkan/sembunyikan di halaman frontend.</p>
                </div>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                           class="w-4.5 h-4.5 text-brand-600 border-gray-300 rounded focus:ring-brand-500 focus:ring-2">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
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

// Setup Drag & Drop
const dropZone = document.getElementById('photo-drop-zone');
const fileInput = document.getElementById('photo');

if (dropZone && fileInput) {
    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('border-brand-400', 'bg-brand-50');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-brand-400', 'bg-brand-50');
    });

    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-brand-400', 'bg-brand-50');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
            previewImage(fileInput, 'photo-preview-img', 'photo-preview-wrap', 'photo-placeholder');
        }
    });
}
</script>
@endpush
