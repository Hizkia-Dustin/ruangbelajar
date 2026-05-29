@extends('admin.layouts.app')
@section('title', 'Edit Program')
@section('page-title', 'Edit Program')
@section('breadcrumb', 'Program › ' . $program->display_title)

@section('content')
<div class="space-y-6">

{{-- ===== FORM EDIT PROGRAM ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
        <div>
            <h2 class="font-semibold text-gray-800">Informasi Program</h2>
            <p class="text-xs text-gray-400">{{ $program->display_title }}</p>
        </div>
        <div class="flex items-center gap-2">
            @if($program->is_featured)
                <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-semibold">⭐ Unggulan</span>
            @endif
            <span class="text-xs {{ $program->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} px-3 py-1 rounded-full font-semibold">
                {{ $program->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.programs.update', $program) }}" enctype="multipart/form-data" id="program-form">
        @csrf @method('PUT')
        @include('admin.program._form', ['program' => $program])
    </form>
</div>

{{-- ===== POIN-POIN PROGRAM ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="features">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 text-green-700 rounded-lg flex items-center justify-center text-sm">✅</div>
            <div>
                <h3 class="font-semibold text-gray-800 text-sm">Poin-Poin Program</h3>
                <p class="text-xs text-gray-400">{{ $program->features->count() }} poin terdaftar</p>
            </div>
        </div>
    </div>
    @if($program->features->isEmpty())
        <div class="py-10 text-center text-gray-400 text-sm">Belum ada poin program. Masukkan data di form bawah untuk menambahkan.</div>
    @else
        <div class="divide-y divide-gray-50">
            @foreach($program->features as $feature)
            <div class="flex items-center justify-between px-6 py-3.5 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-green-600 bg-green-50 border border-green-100 px-2 py-0.5 rounded-lg">#{{ $feature->sort_order }}</span>
                    <span class="text-sm text-gray-700 font-medium">{{ $feature->feature_text }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="openEditFeature({{ $feature->id }}, '{{ addslashes($feature->feature_text) }}', '{{ $feature->icon }}', {{ $feature->sort_order }})"
                            class="p-1.5 text-brand-600 hover:bg-brand-50 rounded-lg transition text-xs" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <form method="POST" action="{{ route('admin.programs.features.destroy', [$program, $feature]) }}" onsubmit="return confirm('Hapus poin ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- Form Tambah Poin (Inline) --}}
    <div class="p-6 bg-slate-50 border-t border-gray-100">
        <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Tambah Poin Baru</h4>
        <form method="POST" action="{{ route('admin.programs.features.store', $program) }}" class="flex flex-col sm:flex-row gap-3 items-end">
            @csrf
            <div class="flex-1">
                <label class="block text-[10px] font-bold text-gray-500 mb-1">Teks Poin *</label>
                <input type="text" name="feature_text" required placeholder="Contoh: Kelas kecil"
                       class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 bg-white transition">
            </div>
            <div class="w-24">
                <label class="block text-[10px] font-bold text-gray-500 mb-1">Urutan</label>
                <input type="number" name="sort_order" min="0" value="{{ $program->features->count() + 1 }}"
                       class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 bg-white transition">
            </div>
            <div>
                <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Poin
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== HIGHLIGHT / VALUE UTAMA ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="highlights">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-purple-100 text-purple-700 rounded-lg flex items-center justify-center text-sm">💡</div>
            <div>
                <h3 class="font-semibold text-gray-800 text-sm">Highlight / Value Utama</h3>
                <p class="text-xs text-gray-400">{{ $program->highlights->count() }} highlight terdaftar</p>
            </div>
        </div>
        <button onclick="toggleModal('modal-highlight')"
                class="flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Highlight
        </button>
    </div>
    @if($program->highlights->isEmpty())
        <div class="py-10 text-center text-gray-400 text-sm">Belum ada highlight. Klik "Tambah Highlight".</div>
    @else
        <div class="divide-y divide-gray-50">
            @foreach($program->highlights as $hl)
            <div class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $hl->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $hl->description }}</p>
                </div>
                <div class="flex items-center gap-2 ml-4">
                    <button onclick="openEditHighlight({{ $hl->id }}, '{{ addslashes($hl->title) }}', '{{ addslashes($hl->description) }}', {{ $hl->sort_order ?? 0 }})"
                            class="p-1.5 text-brand-600 hover:bg-brand-50 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <form method="POST" action="{{ route('admin.programs.highlights.destroy', [$program, $hl]) }}" onsubmit="return confirm('Hapus highlight ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

</div>

{{-- === MODAL EDIT POIN === --}}
<div id="modal-feature" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-feature')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-feature-title" class="font-semibold text-gray-800">Edit Poin Program</h3>
            <button onclick="toggleModal('modal-feature')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="feature-form" method="POST" action="{{ route('admin.programs.features.store', $program) }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="feature-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Teks Poin <span class="text-red-400">*</span></label>
                <input type="text" name="feature_text" id="feature-text" required placeholder="Contoh: Kelas kecil"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Icon</label>
                    <input type="text" name="icon" id="feature-icon" placeholder="fas fa-check"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                    <input type="number" name="sort_order" id="feature-sort" min="0" value="{{ $program->features->count() + 1 }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-feature')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-green-600 hover:bg-green-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- === MODAL TAMBAH HIGHLIGHT === --}}
<div id="modal-highlight" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-highlight')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-hl-title" class="font-semibold text-gray-800">Tambah Highlight</h3>
            <button onclick="toggleModal('modal-highlight')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="highlight-form" method="POST" action="{{ route('admin.programs.highlights.store', $program) }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="hl-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Value <span class="text-red-400">*</span></label>
                <input type="text" name="title" id="hl-title" required placeholder="Kurikulum Fleksibel & Teruji"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                <textarea name="description" id="hl-desc" rows="3" required
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-highlight')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-purple-600 hover:bg-purple-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
const programId = {{ $program->id }};

function toggleModal(id) { const m = document.getElementById(id); m.classList.toggle('hidden'); m.classList.toggle('flex'); }

// Edit Feature
function openEditFeature(id, text, icon, sort) {
    const baseUrl = `/admin/programs/${programId}/features/${id}`;
    document.getElementById('feature-form').action = baseUrl;
    document.getElementById('feature-method').value = 'PUT';
    document.getElementById('feature-text').value = text;
    document.getElementById('feature-icon').value = icon || '';
    document.getElementById('feature-sort').value = sort;
    document.getElementById('modal-feature-title').textContent = 'Edit Poin Program';
    toggleModal('modal-feature');
}

// Edit Highlight
function openEditHighlight(id, title, desc, sort) {
    const baseUrl = `/admin/programs/${programId}/highlights/${id}`;
    document.getElementById('highlight-form').action = baseUrl;
    document.getElementById('hl-method').value = 'PUT';
    document.getElementById('hl-title').value = title;
    document.getElementById('hl-desc').value = desc;
    document.getElementById('modal-hl-title').textContent = 'Edit Highlight';
    toggleModal('modal-highlight');
}

// Reset modal on close for add-new mode
document.querySelectorAll('[onclick*="toggleModal"]').forEach(btn => {
    if (btn.textContent.includes('Tambah')) {
        btn.addEventListener('click', () => {
            setTimeout(() => {
                const fform = document.getElementById('feature-form');
                const hform = document.getElementById('highlight-form');
                if (fform && fform.action.includes('/features/') === false) {
                    fform.action = `/admin/programs/${programId}/features`;
                    document.getElementById('feature-method').value = 'POST';
                    fform.reset();
                    document.getElementById('modal-feature-title').textContent = 'Tambah Fitur';
                }
                if (hform && hform.action.includes('/highlights/') === false) {
                    hform.action = `/admin/programs/${programId}/highlights`;
                    document.getElementById('hl-method').value = 'POST';
                    hform.reset();
                    document.getElementById('modal-hl-title').textContent = 'Tambah Highlight';
                }
            }, 50);
        });
    }
});
</script>
@endpush
