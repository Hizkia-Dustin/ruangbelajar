@extends('admin.layouts.app')
@section('title', 'Sosial Media')
@section('page-title', 'Kelola Sosial Media')
@section('breadcrumb', 'Atur link sosial media yang tampil di footer dan kontak')

@section('content')
<div class="space-y-5">

{{-- Header + Tambah --}}
<div class="flex items-center justify-between">
    <p class="text-sm text-gray-500">{{ $socialMedia->count() }} platform terdaftar · {{ $socialMedia->where('is_active', true)->count() }} aktif</p>
    <button onclick="toggleModal('modal-sosmed')"
            class="flex items-center gap-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Platform
    </button>
</div>

{{-- Platform Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($socialMedia as $sm)
    @php
        $platformColor = \App\Models\SocialMedia::PLATFORMS[$sm->platform]['color'] ?? '#6B7280';
    @endphp
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition {{ !$sm->is_active ? 'opacity-60' : '' }}">
        <div class="px-5 py-4">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-lg shadow"
                         style="background-color: {{ $platformColor }}">
                        <i class="{{ $sm->auto_icon }}"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $sm->platform }}</p>
                        @if($sm->username)
                        <p class="text-xs text-gray-400">{{ $sm->username }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <form method="POST" action="{{ route('admin.sosmed.toggle', $sm) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="w-8 h-5 rounded-full transition relative {{ $sm->is_active ? 'bg-green-400' : 'bg-gray-200' }}"
                                title="{{ $sm->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <span class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform {{ $sm->is_active ? 'translate-x-3' : '' }}"></span>
                        </button>
                    </form>
                </div>
            </div>
            <a href="{{ $sm->url }}" target="_blank" class="mt-3 block text-xs text-brand-600 hover:underline truncate">{{ $sm->url }}</a>
        </div>
        <div class="border-t border-gray-50 flex divide-x divide-gray-50">
            <button onclick="openEditSosmed({{ $sm->id }}, '{{ addslashes($sm->platform) }}', '{{ addslashes($sm->username ?? '') }}', '{{ addslashes($sm->url) }}', '{{ addslashes($sm->icon ?? '') }}', {{ $sm->sort_order }}, {{ $sm->is_active ? 'true' : 'false' }})"
                    class="flex-1 py-2.5 text-xs text-brand-600 hover:bg-brand-50 transition font-semibold flex items-center justify-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </button>
            <form method="POST" action="{{ route('admin.sosmed.destroy', $sm) }}" onsubmit="return confirm('Hapus {{ $sm->platform }}?')" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-2.5 text-xs text-red-500 hover:bg-red-50 transition font-semibold flex items-center justify-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 py-20 text-center text-gray-400">
        <div class="text-5xl mb-4">📱</div>
        <p class="font-semibold text-gray-500">Belum ada sosial media</p>
        <p class="text-sm mt-1">Klik "Tambah Platform" untuk memulai.</p>
    </div>
    @endforelse
</div>

</div>

{{-- Modal Tambah/Edit Sosmed --}}
<div id="modal-sosmed" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeSosmedModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-sosmed-title" class="font-semibold text-gray-800">Tambah Platform</h3>
            <button onclick="closeSosmedModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="sosmed-form" method="POST" action="{{ route('admin.sosmed.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="sosmed-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Platform <span class="text-red-400">*</span></label>
                <select name="platform" id="sosmed-platform"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @foreach($platforms as $p)
                    <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Username</label>
                <input type="text" name="username" id="sosmed-username" placeholder="@ruangbelajar"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">URL Lengkap <span class="text-red-400">*</span></label>
                <input type="url" name="url" id="sosmed-url" required placeholder="https://instagram.com/ruangbelajar.id"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                    <input type="number" name="sort_order" id="sosmed-sort" min="0" value="1"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="sosmed-active" value="1" checked class="w-4 h-4 text-brand-600 rounded border-gray-300">
                        <span class="text-sm text-gray-600">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeSosmedModal()" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleModal(id) { const m=document.getElementById(id); m.classList.toggle('hidden'); m.classList.toggle('flex'); }
function closeSosmedModal() { const m=document.getElementById('modal-sosmed'); m.classList.add('hidden'); m.classList.remove('flex'); }

function openEditSosmed(id, platform, username, url, icon, sort, isActive) {
    document.getElementById('sosmed-form').action = `/admin/sosmed/${id}`;
    document.getElementById('sosmed-method').value = 'PUT';
    document.getElementById('sosmed-platform').value = platform;
    document.getElementById('sosmed-username').value = username;
    document.getElementById('sosmed-url').value = url;
    document.getElementById('sosmed-sort').value = sort;
    document.getElementById('sosmed-active').checked = isActive;
    document.getElementById('modal-sosmed-title').textContent = 'Edit Platform';
    toggleModal('modal-sosmed');
}
</script>
@endpush
