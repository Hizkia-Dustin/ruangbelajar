@extends('admin.layouts.app')
@section('title', 'Kelola Testimoni')
@section('page-title', 'CMS Testimoni')
@section('breadcrumb', 'Kelola testimoni wali murid dan penampilannya di website')

@section('content')
<div class="space-y-6">

    {{-- Filter & Search Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <form method="GET" action="{{ route('admin.testimonials.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Search Input --}}
            <div>
                <label for="search" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Pencarian</label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari nama atau isi testimoni..."
                           class="w-full pl-9 pr-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Location Filter --}}
            <div>
                <label for="display_location" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Lokasi Tampilan</label>
                <select name="display_location" id="display_location" onchange="this.form.submit()"
                        class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <option value="">Semua Lokasi</option>
                    <option value="home" {{ $location == 'home' ? 'selected' : '' }}>Halaman Beranda</option>
                    <option value="about" {{ $location == 'about' ? 'selected' : '' }}>Halaman Tentang Kami</option>
                    <option value="both" {{ $location == 'both' ? 'selected' : '' }}>Keduanya (Home & About)</option>
                </select>
            </div>

            {{-- Status Filter --}}
            <div>
                <label for="is_active" class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Status</label>
                <select name="is_active" id="is_active" onchange="this.form.submit()"
                        class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <option value="">Semua Status</option>
                    <option value="1" {{ $status === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $status === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- Actions / Reset --}}
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center justify-center gap-1.5 shadow-sm">
                    Filter
                </button>
                @if($search || $location || $status !== null && $status !== '')
                    <a href="{{ route('admin.testimonials.index') }}" class="py-2 px-3 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-semibold rounded-xl transition text-center flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Main Card Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center text-sm">❤️</div>
                <div>
                    <h2 class="font-semibold text-gray-800 text-sm">Daftar Testimoni</h2>
                    <p class="text-xs text-gray-400">{{ $testimonials->total() }} item terdaftar</p>
                </div>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
               class="flex items-center gap-1.5 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Testimoni
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            @if($testimonials->isEmpty())
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">❤️</div>
                    <p class="text-sm font-medium">Belum ada testimoni</p>
                    <p class="text-xs mt-1">Tidak ada data testimoni yang cocok dengan kriteria pencarian.</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-center w-14">Urutan</th>
                            <th class="px-6 py-3 text-left w-16">Foto</th>
                            <th class="px-6 py-3 text-left">Orang Tua / Wali</th>
                            <th class="px-6 py-3 text-left">Isi Ulasan</th>
                            <th class="px-6 py-3 text-center">Rating</th>
                            <th class="px-6 py-3 text-center">Tampil Di</th>
                            <th class="px-6 py-3 text-center">Featured</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($testimonials as $item)
                        <tr class="hover:bg-gray-50/80 transition {{ $item->is_active ? '' : 'opacity-60 bg-gray-50/30' }}">
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">{{ $item->sort_order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" class="w-10 h-10 rounded-xl object-cover border border-gray-100 shadow-sm" alt="{{ $item->name }}">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $item->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $item->role }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-600 line-clamp-2 max-w-sm" title="{{ $item->testimonial }}">{{ $item->testimonial }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center text-[11px] text-amber-400" title="{{ $item->rating }} Bintang">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            ★
                                        @else
                                            <span class="text-gray-200">★</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->tampil_di_beranda && $item->tampil_di_tentang)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">Keduanya</span>
                                @elseif($item->tampil_di_beranda)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100">Beranda</span>
                                @elseif($item->tampil_di_tentang)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-100">Tentang Kami</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-500 border border-gray-100">Tidak Tampil</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.testimonials.toggle-featured', $item) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="transition inline-block"
                                            title="{{ $item->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}">
                                        @if($item->is_featured)
                                            <svg class="w-5 h-5 text-amber-400 fill-current hover:scale-110 transition-transform" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300 stroke-current fill-none hover:text-amber-400 hover:scale-110 transition-colors duration-150" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.testimonials.toggle-active', $item) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition
                                                   {{ $item->is_active ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.testimonials.edit', $item) }}"
                                       class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button type="button" onclick="confirmDelete('{{ route('admin.testimonials.destroy', $item) }}', '{{ addslashes($item->name) }}')"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Pagination --}}
        @if($testimonials->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Modal Delete Confirmation --}}
<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
        <div class="text-center">
            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">⚠️</div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-500 mb-6" id="delete-modal-text">Apakah Anda yakin ingin menghapus testimoni ini?</p>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <form id="delete-form" method="POST" action="" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(url, name) {
    const modal = document.getElementById('delete-modal');
    const form = document.getElementById('delete-form');
    const text = document.getElementById('delete-modal-text');
    
    form.action = url;
    text.innerHTML = `Apakah Anda yakin ingin menghapus testimoni dari <strong>${name}</strong>? Tindakan ini tidak dapat dibatalkan.`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush
