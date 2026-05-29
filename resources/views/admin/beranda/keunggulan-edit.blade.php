@extends('admin.layouts.app')
@section('title', 'Edit Keunggulan')
@section('page-title', 'Edit Keunggulan')
@section('breadcrumb', 'Beranda › Keunggulan › Edit')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Edit Keunggulan</h2>
            <p class="text-xs text-gray-400 mt-0.5">Ubah data keunggulan yang sudah ada</p>
        </div>

        <form method="POST" action="{{ route('admin.beranda.keunggulan.update', $keunggulan) }}" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $keunggulan->sort_order) }}" min="0"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $keunggulan->title) }}" required
                       class="w-full px-3 py-2.5 border @error('title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required
                          class="w-full px-3 py-2.5 border @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $keunggulan->description) }}</textarea>
                @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ $keunggulan->is_active ? 'checked' : '' }}
                       class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="is_active" class="text-sm text-gray-600">Aktif (tampil di website)</label>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.beranda.index') }}#keunggulan"
                   class="flex-1 text-center py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
