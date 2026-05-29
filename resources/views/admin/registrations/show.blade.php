@extends('admin.layouts.app')
@section('title', 'Detail Pendaftar')
@section('page-title', 'Detail Pendaftar')
@section('breadcrumb', 'Data Pendaftar › ' . $registration->student_name)

@section('content')
@php
$badgeMap = \App\Models\Registration::STATUS_BADGES;
$badge = $badgeMap[$registration->status] ?? 'bg-gray-100 text-gray-600';
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

{{-- ======= LEFT: Identitas + Aksi ======= --}}
<div class="lg:col-span-1 space-y-5">

    {{-- Kartu Identitas --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-brand-600 to-brand-800 px-6 py-8 text-center text-white relative">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-3xl font-black mx-auto mb-3">
                {{ strtoupper(substr($registration->student_name, 0, 1)) }}
            </div>
            <h2 class="font-bold text-lg">{{ $registration->student_name }}</h2>
            <p class="text-brand-200 text-sm mt-0.5">Wali: {{ $registration->parent_name }}</p>
            <div class="mt-3">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full border {{ $badge }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    {{ $registration->status_label }}
                </span>
            </div>
        </div>
        <div class="p-5 space-y-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-gray-500">Usia</span>
                <span class="font-medium text-gray-800">{{ $registration->age ? $registration->age . ' tahun' : '–' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500">Kelas</span>
                <span class="font-medium text-gray-800">{{ $registration->class_name ?: '–' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500">Sekolah</span>
                <span class="font-medium text-gray-800 text-right max-w-[60%]">{{ $registration->school ?: '–' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500">Program</span>
                <span class="font-medium text-gray-800 text-right max-w-[60%]">{{ $registration->display_program }}</span>
            </div>
            <div class="border-t border-gray-100 pt-3">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-500">WhatsApp</span>
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$registration->whatsapp) }}" target="_blank"
                       class="font-medium text-green-600 hover:underline flex items-center gap-1">
                        <i class="fab fa-whatsapp"></i> {{ $registration->whatsapp }}
                    </a>
                </div>
                @if($registration->email)
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Email</span>
                    <span class="font-medium text-gray-800 text-xs">{{ $registration->email }}</span>
                </div>
                @endif
            </div>
            <div class="border-t border-gray-100 pt-3 text-xs text-gray-400 space-y-1">
                <p>Daftar: {{ $registration->created_at->format('d M Y, H:i') }}</p>
                @if($registration->contacted_at)
                <p>Dihubungi: {{ $registration->contacted_at->format('d M Y, H:i') }}</p>
                @endif
                @if($registration->source)
                <p>Sumber: {{ $registration->source }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-semibold text-gray-800 text-sm mb-3">Ubah Status</h3>
        <form method="POST" action="{{ route('admin.registrations.update-status', $registration) }}">
            @csrf @method('PATCH')
            <div class="space-y-2">
                @foreach($statuses as $val => $label)
                <label class="flex items-center gap-3 p-2.5 rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $registration->status==$val ? 'bg-brand-50 ring-1 ring-brand-300' : '' }}">
                    <input type="radio" name="status" value="{{ $val }}" {{ $registration->status==$val?'checked':'' }}
                           class="text-brand-600 border-gray-300">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full border {{ \App\Models\Registration::STATUS_BADGES[$val] ?? 'bg-gray-100 text-gray-600' }}">{{ $label }}</span>
                </label>
                @endforeach
            </div>
            <button type="submit" class="w-full mt-3 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition">
                Simpan Status
            </button>
        </form>
    </div>

    {{-- Follow Up WA Button --}}
    @php
        $waMessage = urlencode("Halo Kak, kami dari Ruang Belajar ingin menindaklanjuti pendaftaran atas nama " . $registration->student_name . ". Apakah masih berminat untuk konsultasi program belajar?");
        $waPhone = preg_replace('/\D/', '', $registration->whatsapp);
    @endphp
    <a href="https://wa.me/{{ $waPhone }}?text={{ $waMessage }}"
       target="_blank"
       class="flex items-center justify-center gap-2 w-full py-3 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-2xl transition shadow-sm">
        <i class="fab fa-whatsapp text-lg"></i> Follow Up via WhatsApp
    </a>

    {{-- Hapus --}}
    <form method="POST" action="{{ route('admin.registrations.destroy', $registration) }}"
          onsubmit="return confirm('Yakin hapus data pendaftar ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="w-full py-2.5 text-red-600 bg-red-50 hover:bg-red-100 text-sm font-semibold rounded-2xl transition">
            🗑️ Hapus Data Ini
        </button>
    </form>

</div>

{{-- ======= RIGHT: Pesan + Catatan Admin ======= --}}
<div class="lg:col-span-2 space-y-5">

    {{-- Pesan dari Pendaftar --}}
    @if($registration->notes)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
            <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs">💬</span>
            Pesan dari Pendaftar
        </h3>
        <p class="text-gray-600 text-sm leading-relaxed bg-gray-50 rounded-xl p-4 italic">
            "{{ $registration->notes }}"
        </p>
    </div>
    @endif

    {{-- Catatan Admin --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
            <span class="w-6 h-6 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-xs">📝</span>
            Catatan Admin
        </h3>
        <form method="POST" action="{{ route('admin.registrations.update-note', $registration) }}">
            @csrf @method('PATCH')
            <textarea name="admin_notes" rows="5"
                      placeholder="Tulis catatan internal untuk pendaftar ini..."
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('admin_notes', $registration->admin_notes) }}</textarea>
            <div class="flex justify-end mt-3">
                <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition">
                    Simpan Catatan
                </button>
            </div>
        </form>
    </div>

    {{-- Info Pipeline Status --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <span class="w-6 h-6 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-xs">📊</span>
            Pipeline Status
        </h3>
        @php
        $pipeline = ['need_contact', 'contacted', 'rejected'];
        $colors   = ['need_contact' => 'bg-amber-400', 'contacted' => 'bg-emerald-400', 'rejected' => 'bg-red-400'];
        $currentIdx = array_search($registration->status, $pipeline);
        @endphp
        <div class="flex items-center gap-2 overflow-x-auto pb-2">
            @foreach($pipeline as $idx => $step)
            @php
                $isActive  = $step === $registration->status;
                $isPast    = ($registration->status !== 'rejected') && ($idx < $currentIdx);
            @endphp
            <div class="flex items-center gap-2 flex-shrink-0">
                <div class="flex flex-col items-center gap-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                        {{ $isActive ? $colors[$step].' text-white ring-2 ring-offset-2 ring-current' : ($isPast ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400') }}">
                        @if($isPast)✓@else{{ $idx+1 }}@endif
                    </div>
                    <p class="text-[10px] text-gray-500 whitespace-nowrap font-medium">{{ \App\Models\Registration::STATUSES[$step] }}</p>
                </div>
                @if(!$loop->last)
                <div class="w-8 h-0.5 {{ $isPast ? 'bg-green-300' : 'bg-gray-200' }} mb-3 flex-shrink-0"></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- Kembali --}}
    <div class="flex justify-end">
        <a href="{{ route('admin.registrations.index') }}"
           class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition flex items-center gap-2">
            ← Kembali ke Daftar
        </a>
    </div>

</div>

</div>
@endsection
