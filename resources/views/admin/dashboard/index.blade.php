@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Selamat datang di Admin Panel Ruang Belajar')

@section('content')

{{-- ============================
     WELCOME BANNER
     ============================ --}}
<div class="bg-gradient-to-r from-brand-700 to-brand-500 rounded-2xl p-6 mb-6 text-white relative overflow-hidden">
    {{-- Decorative circle --}}
    <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/10 rounded-full"></div>
    <div class="absolute -right-2 -bottom-10 w-28 h-28 bg-white/5 rounded-full"></div>

    <div class="relative">
        <p class="text-brand-100 text-sm font-medium mb-1">👋 Halo, {{ $adminName }}!</p>
        <h2 class="text-2xl font-bold">Selamat Datang di Admin Panel</h2>
        <p class="text-brand-200 text-sm mt-1">Kelola seluruh konten website Ruang Belajar dari sini.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.registrations.index') }}"
               class="inline-flex items-center gap-2 bg-white text-brand-700 text-sm font-semibold px-4 py-2 rounded-xl hover:bg-brand-50 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Pendaftar
            </a>
            <a href="{{ route('home') }}" target="_blank"
               class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-medium px-4 py-2 rounded-xl hover:bg-white/30 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Buka Website
            </a>
        </div>
    </div>
</div>

{{-- ============================
     STATS CARDS
     ============================ --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    @php
        $cards = [
            ['label' => 'Total Pendaftar', 'value' => $stats['total_pendaftar'], 'color' => 'blue',   'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Perlu Dihubungi', 'value' => $stats['need_contact'],    'color' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Sudah Dihubungi', 'value' => $stats['contacted'],       'color' => 'green',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Tidak Lanjut',    'value' => $stats['rejected'],        'color' => 'red',    'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];
        $colorMap = [
            'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-blue-600',   'icon' => 'bg-blue-100',   'val' => 'text-blue-700'],
            'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'icon' => 'bg-yellow-100', 'val' => 'text-yellow-700'],
            'green'  => ['bg' => 'bg-green-50',  'text' => 'text-green-600',  'icon' => 'bg-green-100',  'val' => 'text-green-700'],
            'red'    => ['bg' => 'bg-red-50',    'text' => 'text-red-600',    'icon' => 'bg-red-100',    'val' => 'text-red-700'],
        ];
    @endphp

    @foreach($cards as $card)
        @php $c = $colorMap[$card['color']]; @endphp
        <div class="{{ $c['bg'] }} rounded-2xl p-4 border border-white shadow-sm">
            <div class="{{ $c['icon'] }} w-9 h-9 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <p class="text-2xl font-bold {{ $c['val'] }}">{{ $card['value'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5">{{ $card['label'] }}</p>
        </div>
    @endforeach

</div>

{{-- ============================
     GRID: Pendaftar Terbaru + Quick Links
     ============================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Pendaftar Terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Pendaftar Terbaru</h3>
            <a href="{{ route('admin.registrations.index') }}"
               class="text-xs text-brand-600 hover:text-brand-700 font-medium transition-colors">
                Lihat semua →
            </a>
        </div>

        @if($latestRegistrations->isEmpty())
            <div class="py-12 text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-sm">Belum ada data pendaftar</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($latestRegistrations as $reg)
                    @php
                        $statusColors = [
                            'need_contact' => 'bg-amber-100 text-amber-700',
                            'contacted'    => 'bg-emerald-100 text-emerald-700',
                            'rejected'     => 'bg-red-100 text-red-700',
                        ];
                        $statusLabels = [
                            'need_contact' => 'Perlu Dihubungi',
                            'contacted'    => 'Sudah Dihubungi',
                            'rejected'     => 'Tidak Lanjut',
                        ];
                    @endphp
                    <div class="flex items-center gap-4 px-6 py-3.5 hover:bg-gray-50 transition-colors">
                        {{-- Avatar initial --}}
                        <div class="w-9 h-9 bg-brand-100 rounded-full flex items-center justify-center text-brand-700 text-sm font-bold flex-shrink-0">
                            {{ strtoupper(substr($reg->student_name, 0, 1)) }}
                        </div>
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ $reg->student_name }}</p>
                            <p class="text-xs text-gray-400 truncate">
                                {{ $reg->parent_name }} · {{ $reg->display_program }}
                            </p>
                        </div>
                        {{-- Status badge --}}
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full flex-shrink-0 {{ $statusColors[$reg->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $statusLabels[$reg->status] ?? $reg->status }}
                        </span>
                        {{-- Time --}}
                        <span class="text-xs text-gray-400 flex-shrink-0 hidden sm:block">
                            {{ $reg->created_at->diffForHumans() }}
                        </span>
                        {{-- Detail button --}}
                        <a href="{{ route('admin.registrations.show', $reg) }}"
                           class="text-xs font-semibold text-brand-600 bg-brand-50 hover:bg-brand-100 px-3 py-1 rounded-lg transition-colors flex-shrink-0">
                            Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Akses Cepat</h3>
        </div>
        <div class="p-4 space-y-2">
            @php
                $quickLinks = [
                    ['label' => 'Setting Beranda',     'route' => 'admin.beranda.index',             'color' => 'text-blue-600 bg-blue-50',   'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z'],
                    ['label' => 'Setting Tentang',     'route' => 'admin.tentang.index',             'color' => 'text-indigo-600 bg-indigo-50','icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Kelola Program',      'route' => 'admin.programs.index',            'color' => 'text-violet-600 bg-violet-50','icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['label' => 'Setting Kontak',      'route' => 'admin.kontak.index',   'color' => 'text-sky-600 bg-sky-50',     'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                    ['label' => 'Data Pendaftar',      'route' => 'admin.registrations.index',       'color' => 'text-emerald-600 bg-emerald-50','icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['label' => 'Testimoni',           'route' => 'admin.testimonials.index',        'color' => 'text-pink-600 bg-pink-50',   'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z'],
                ];
            @endphp
            @foreach($quickLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $link['color'] }} hover:opacity-80 transition-opacity">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                    </svg>
                    <span class="text-sm font-medium">{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

</div>

@endsection
