@extends('admin.layouts.app')
@section('title', 'Data Pendaftar')
@section('page-title', 'Data Pendaftar')
@section('breadcrumb', 'Kelola semua data calon siswa')

@section('content')
<div class="space-y-5">

    {{-- ======= STAT CARDS ======= --}}
    @php
    $statCards = [
        ['label'=>'Total Pendaftar', 'val'=>$stats['total'],        'color'=>'blue',   'status'=>''],
        ['label'=>'Perlu Dihubungi','val'=>$stats['need_contact'],'color'=>'yellow', 'status'=>'need_contact'],
        ['label'=>'Sudah Dihubungi','val'=>$stats['contacted'],   'color'=>'green',  'status'=>'contacted'],
        ['label'=>'Tidak Lanjut',   'val'=>$stats['rejected'],    'color'=>'red',    'status'=>'rejected'],
    ];
    $cmap = [
        'blue'   =>['bg'=>'bg-blue-50',  'ib'=>'bg-blue-100',  'ic'=>'text-blue-600',  'vt'=>'text-blue-700'],
        'yellow' =>['bg'=>'bg-amber-50', 'ib'=>'bg-amber-100', 'ic'=>'text-amber-600', 'vt'=>'text-amber-700'],
        'green'  =>['bg'=>'bg-green-50', 'ib'=>'bg-green-100', 'ic'=>'text-green-600', 'vt'=>'text-green-700'],
        'red'    =>['bg'=>'bg-red-50',   'ib'=>'bg-red-100',   'ic'=>'text-red-600',   'vt'=>'text-red-700'],
    ];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        @foreach($statCards as $sc)
        @php $c=$cmap[$sc['color']]; @endphp
        <a href="{{ route('admin.registrations.index', ['status'=>$sc['status']]) }}"
           class="{{ $c['bg'] }} rounded-2xl p-4 border border-white shadow-sm hover:shadow-md transition block">
            <div class="{{ $c['ib'] }} w-8 h-8 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-4 h-4 {{ $c['ic'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($sc['color'] === 'blue')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    @elseif($sc['color'] === 'yellow')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    @elseif($sc['color'] === 'green')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    @endif
                </svg>
            </div>
            <p class="text-xl font-bold {{ $c['vt'] }}">{{ $sc['val'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5 leading-tight">{{ $sc['label'] }}</p>
        </a>
        @endforeach
    </div>

    {{-- ======= FILTER BAR ======= --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
        <form method="GET" action="{{ route('admin.registrations.index') }}" id="filter-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama anak / WhatsApp..."
                       class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                <select name="status" class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $val => $label)
                    <option value="{{ $val }}" {{ request('status')==$val?'selected':'' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <select name="program_id" class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                    <option value="">Semua Program</option>
                    @foreach($programs as $prog)
                    <option value="{{ $prog->id }}" {{ request('program_id')==$prog->id?'selected':'' }}>{{ $prog->display_title }}</option>
                    @endforeach
                </select>
                <input type="date" name="date_from" value="{{ request('date_from') }}" title="Dari tanggal daftar"
                       class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                <input type="date" name="date_to" value="{{ request('date_to') }}" title="Sampai tanggal daftar"
                       class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            </div>
            <div class="flex items-center justify-between mt-3">
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Filter
                    </button>
                    <a href="{{ route('admin.registrations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-semibold rounded-xl transition">Reset</a>
                </div>
                <a href="{{ route('admin.registrations.export-csv', request()->query()) }}"
                   class="flex items-center gap-1.5 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Export CSV
                </a>
            </div>
        </form>
    </div>

    {{-- ======= BULK ACTION BAR ======= --}}
    <form method="POST" action="{{ route('admin.registrations.bulk') }}" id="bulk-form">
        @csrf
        <div id="bulk-bar" class="hidden bg-brand-50 border border-brand-200 rounded-2xl px-5 py-3 flex items-center justify-between">
            <p class="text-sm text-brand-700 font-semibold"><span id="selected-count">0</span> item dipilih</p>
            <div class="flex items-center gap-2">
                <select name="action" class="px-3 py-1.5 border border-brand-300 rounded-lg text-xs focus:outline-none bg-white">
                    <option value="">Pilih Aksi</option>
                    <option value="need_contact">→ Perlu Dihubungi</option>
                    <option value="contacted">→ Sudah Dihubungi</option>
                    <option value="rejected">→ Tidak Lanjut</option>
                    <option value="delete">🗑️ Hapus</option>
                </select>
                <button type="submit" onclick="return confirm('Terapkan aksi ke semua item terpilih?')"
                        class="px-4 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-lg transition">
                    Terapkan
                </button>
                <button type="button" onclick="clearSelection()" class="px-3 py-1.5 text-xs text-gray-500 hover:text-gray-700">Batal</button>
            </div>
        </div>

        {{-- ======= TABLE ======= --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            @if($registrations->isEmpty())
                <div class="py-20 text-center text-gray-400">
                    <div class="text-5xl mb-4">📋</div>
                    <p class="font-semibold text-gray-500">Belum ada data pendaftar</p>
                    <p class="text-sm mt-1">Data akan muncul setelah ada yang mengisi form pendaftaran.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-center w-10">
                                    <input type="checkbox" id="check-all" class="w-4 h-4 rounded text-brand-600 border-gray-300">
                                </th>
                                <th class="px-4 py-3 text-left w-12">#</th>
                                <th class="px-4 py-3 text-left">Nama Anak</th>
                                <th class="px-4 py-3 text-center w-20">Umur</th>
                                <th class="px-4 py-3 text-center w-24">Kelas</th>
                                <th class="px-4 py-3 text-left">Program</th>
                                <th class="px-4 py-3 text-left">Nomor WhatsApp</th>
                                <th class="px-4 py-3 text-center w-40">Status</th>
                                <th class="px-4 py-3 text-center">Tanggal Daftar</th>
                                <th class="px-4 py-3 text-center w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($registrations as $i => $reg)
                            @php $badge = \App\Models\Registration::STATUS_BADGES[$reg->status] ?? 'bg-gray-100 text-gray-600'; @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $reg->id }}" class="row-check w-4 h-4 rounded text-brand-600 border-gray-300">
                                </td>
                                <td class="px-4 py-3 text-gray-400 text-xs">{{ $registrations->firstItem() + $i }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center text-brand-700 text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($reg->student_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $reg->student_name }}</p>
                                            <p class="text-[10px] text-gray-400">Wali: {{ $reg->parent_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center font-medium text-gray-700">
                                    {{ $reg->age ? $reg->age . ' Thn' : '–' }}
                                </td>
                                <td class="px-4 py-3 text-center text-gray-600">
                                    {{ $reg->class_name ?: '–' }}
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-700 text-xs font-semibold">{{ $reg->display_program }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="https://wa.me/{{ preg_replace('/\D/','',$reg->whatsapp) }}" target="_blank"
                                       class="text-xs text-brand-600 hover:text-brand-700 font-bold flex items-center gap-1">
                                        <i class="fab fa-whatsapp text-green-500 text-sm"></i> {{ $reg->whatsapp }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.registrations.update-status', $reg) }}">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="text-xs font-bold px-3 py-1 rounded-full border {{ $badge }} focus:outline-none cursor-pointer bg-white/30">
                                            @foreach($statuses as $val => $label)
                                            <option value="{{ $val }}" {{ $reg->status==$val?'selected':'' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center text-xs text-gray-500">
                                    {{ $reg->created_at->format('d/m/Y') }}
                                    <span class="block text-[10px] text-gray-400 mt-0.5">{{ $reg->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $waMessage = urlencode("Halo Kak, kami dari Ruang Belajar ingin menindaklanjuti pendaftaran atas nama " . $reg->student_name . ". Apakah masih berminat untuk konsultasi program belajar?");
                                        $waNumber = preg_replace('/\D/', '', $reg->whatsapp);
                                    @endphp
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.registrations.show', $reg) }}"
                                           class="p-1.5 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}" target="_blank"
                                           class="p-1.5 text-green-600 hover:bg-green-50 rounded-lg transition" title="Hubungi via WhatsApp">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.022-.004-.047-.013-.075-.026-.26-.128-1.541-.76-1.78-.847-.23-.087-.4-.13-.57.128-.17.257-.657.847-.805 1.012-.148.165-.297.185-.556.058-.26-.128-1.097-.404-2.09-1.293-.77-.687-1.29-1.537-1.44-1.796-.15-.257-.016-.396.113-.525.116-.117.257-.3.385-.45.127-.15.17-.258.256-.429.087-.17.043-.32-.022-.45-.064-.13-.57-1.37-.78-1.88-.204-.5-.428-.43-.586-.438-.148-.008-.32-.01-.492-.01-.17 0-.447.064-.68.314-.233.25-1.002 1.002-1.002 2.443 0 1.442 1.05 2.836 1.196 3.03.147.193 2.062 3.148 4.996 4.417.698.301 1.242.482 1.667.618.702.223 1.34.191 1.84.116.56-.084 1.78-.727 2.03-1.43.25-.702.25-1.303.175-1.43-.077-.127-.224-.205-.53-.357zM12 2C6.48 2 2 6.48 2 12c0 2.17.69 4.19 1.87 5.86L2.5 21.5l3.82-1.32C7.9 21.2 9.89 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.84 0-3.56-.63-4.94-1.68l-.35-.27-2.28.79.8-2.2-.31-.38C3.82 15.14 3.2 13.62 3.2 12 3.2 7.15 7.15 3.2 12 3.2s8.8 3.95 8.8 8.8-3.95 8.8-8.8 8.8z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.registrations.destroy', $reg) }}"
                                              onsubmit="return confirm('Hapus pendaftar \'{{ addslashes($reg->student_name) }}\'?')">
                                            @csrf @method('DELETE')
                                            <button class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
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

                {{-- Pagination --}}
                @if($registrations->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $registrations->links() }}
                </div>
                @endif
            @endif
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
// Check-all
const checkAll = document.getElementById('check-all');
const bulkBar  = document.getElementById('bulk-bar');
const countEl  = document.getElementById('selected-count');

function updateBulkBar() {
    const checked = document.querySelectorAll('.row-check:checked').length;
    countEl.textContent = checked;
    if (checked > 0) { bulkBar.classList.remove('hidden'); bulkBar.classList.add('flex'); }
    else             { bulkBar.classList.add('hidden');    bulkBar.classList.remove('flex'); }
}

function clearSelection() {
    document.querySelectorAll('.row-check, #check-all').forEach(c => c.checked = false);
    updateBulkBar();
}

checkAll?.addEventListener('change', function() {
    document.querySelectorAll('.row-check').forEach(c => c.checked = this.checked);
    updateBulkBar();
});
document.querySelectorAll('.row-check').forEach(c => c.addEventListener('change', updateBulkBar));

// Auto-submit filter on select change
document.querySelectorAll('#filter-form select').forEach(s => {
    s.addEventListener('change', () => document.getElementById('filter-form').submit());
});
</script>
@endpush
