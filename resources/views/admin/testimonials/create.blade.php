@extends('admin.layouts.app')
@section('title', 'Tambah Testimoni')
@section('page-title', 'Tambah Testimoni Baru')
@section('breadcrumb', 'Buat testimoni baru untuk ditampilkan di website')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white">
            <div class="w-8 h-8 bg-brand-100 text-brand-700 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Form Testimoni Baru</h2>
                <p class="text-xs text-gray-400">Silakan lengkapi kolom di bawah untuk menambahkan testimoni baru</p>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" id="testimonial-form" class="p-6">
            @csrf

            @include('admin.testimonials._form')

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-3 mt-8 border-t border-gray-100 pt-5">
                <a href="{{ route('admin.testimonials.index') }}"
                   class="px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition flex items-center gap-2 font-medium">
                    Batal
                </a>
                <button type="submit" id="submit-btn"
                        class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Testimoni
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Loading state pada submit
    document.getElementById('testimonial-form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`;
    });
</script>
@endpush
