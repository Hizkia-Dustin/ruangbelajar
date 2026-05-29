@extends('admin.layouts.app')
@section('title', 'Program')
@section('page-title', 'Daftar Program')
@section('breadcrumb', 'Kelola semua program bimbingan belajar')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">{{ $programs->count() }} program terdaftar · {{ $programs->where('is_active', true)->count() }} aktif · {{ $programs->where('is_featured', true)->count() }} unggulan</p>
        </div>
        <a href="{{ route('admin.programs.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Program
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if($programs->isEmpty())
            <div class="py-20 text-center text-gray-400">
                <div class="text-5xl mb-4">📚</div>
                <p class="font-semibold text-gray-500">Belum ada program</p>
                <p class="text-sm mt-1">Klik "Tambah Program" untuk mulai menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Program</th>
                            <th class="px-6 py-3 text-center">Fitur</th>
                            <th class="px-6 py-3 text-center">Unggulan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Urutan</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($programs as $i => $program)
                        <tr class="hover:bg-gray-50 transition {{ $program->is_active ? '' : 'opacity-50' }}">
                            <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php $img = $program->thumbnail ?: $program->image; @endphp
                                    @if($img)
                                        <img src="{{ asset('storage/'.$img) }}" alt="" class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                                    @else
                                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <i class="{{ $program->display_icon }}"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $program->display_title }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if($program->badge_text)
                                                <span class="text-[9px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full font-bold uppercase">{{ $program->badge_text }}</span>
                                            @endif
                                            @if($program->display_age_range)
                                                <span class="text-[9px] text-gray-400 font-medium">{{ $program->display_age_range }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center min-w-[2rem] h-7 px-2 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">
                                    {{ $program->features_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.programs.toggle-featured', $program) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-lg {{ $program->is_featured ? 'text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-yellow-400' }} transition" title="{{ $program->is_featured ? 'Hapus dari unggulan' : 'Jadikan unggulan' }}">
                                        <i class="{{ $program->is_featured ? 'fas' : 'far' }} fa-star"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.programs.toggle', $program) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition {{ $program->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $program->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $program->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">
                                    {{ $program->sort_order ?: $program->urutan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.programs.edit', $program) }}"
                                       class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.programs.destroy', $program) }}"
                                          onsubmit="return confirm('Hapus program \'{{ addslashes($program->display_title) }}\'?\nSemua fitur dan highlight akan ikut terhapus.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
@endsection
