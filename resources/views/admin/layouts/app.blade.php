<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Admin Dashboard — Ruang Belajar" />
    <title>@yield('title', 'Dashboard') — Admin Ruang Belajar</title>

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        accent: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        sidebar: '#0f172a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Sidebar */
        .sidebar { background: #0f172a; }
        .sidebar-link {
            transition: all 0.15s ease;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,0.08);
            padding-left: 1.25rem;
        }
        .sidebar-link.active {
            background: rgba(37, 99, 235, 0.25);
            border-left: 3px solid #2563eb;
            color: #93c5fd;
        }
        .sidebar-link.active svg {
            color: #60a5fa;
        }

        /* Scrollbar tipis */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

        /* Flash message animation */
        .flash-msg {
            animation: slideDown 0.3s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Mobile overlay */
        #sidebar-overlay { transition: opacity 0.3s ease; }

        /* Sidebar mobile slide */
        #sidebar { transition: transform 0.3s ease; }
    </style>

    @stack('styles')
</head>

<body class="h-full bg-gray-50 flex overflow-hidden">

{{-- ===================== SIDEBAR ===================== --}}
<aside id="sidebar"
       class="sidebar fixed inset-y-0 left-0 z-40 w-64 flex flex-col
              -translate-x-full lg:translate-x-0 transition-transform duration-300">

    {{-- Sidebar Header / Brand --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
        <div class="w-9 h-9 bg-brand-600 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold text-sm leading-none">Ruang Belajar</p>
            <p class="text-slate-400 text-xs mt-0.5">Admin Panel</p>
        </div>
        {{-- Close btn (mobile) --}}
        <button id="close-sidebar" class="ml-auto lg:hidden text-slate-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

        {{-- MENU GROUP: Utama --}}
        <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest px-3 pt-2 pb-1">Utama</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-4.5 h-4.5 w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        {{-- MENU GROUP: Konten --}}
        <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest px-3 pt-4 pb-1">Konten Website</p>

        <a href="{{ route('admin.beranda.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Beranda
        </a>

        <a href="{{ route('admin.tentang.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tentang Kami
        </a>

        <a href="{{ route('admin.programs.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Program
        </a>

        <a href="{{ route('admin.kontak.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            Kontak
        </a>

        <a href="{{ route('admin.footer.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.footer.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
            Footer
        </a>

        <a href="{{ route('admin.sosmed.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.sosmed.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
            Sosial Media
        </a>

        {{-- MENU GROUP: Pendaftaran --}}
        <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest px-3 pt-4 pb-1">Pendaftaran</p>

        <a href="{{ route('admin.registrations.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            Data Pendaftar
        </a>

        <a href="{{ route('admin.register.hero.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.register.hero.*') || request()->routeIs('admin.register.benefits.*') || request()->routeIs('admin.register.form-setting.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Setting Halaman Daftar
        </a>

        {{-- MENU GROUP: Lainnya --}}
        <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest px-3 pt-4 pb-1">Lainnya</p>

        <a href="{{ route('admin.testimonials.index') }}"
           class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-300 {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z"/>
            </svg>
            Testimoni
        </a>


    </nav>

    {{-- Sidebar Footer: User Info & Logout --}}
    <div class="border-t border-white/10 px-3 py-3">
        <div class="flex items-center gap-3 px-3 py-2 mb-1">
            <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center flex-shrink-0 text-white text-xs font-bold">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-white text-xs font-medium truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-slate-500 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-150 text-left">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>

{{-- Mobile overlay --}}
<div id="sidebar-overlay"
     class="fixed inset-0 z-30 bg-black/60 opacity-0 pointer-events-none lg:hidden"
     onclick="closeSidebar()">
</div>

{{-- ===================== MAIN CONTENT ===================== --}}
<div class="flex-1 flex flex-col min-h-screen lg:ml-64 min-w-0">

    {{-- TOP NAVBAR --}}
    <header class="sticky top-0 z-20 bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-4 sm:px-6 h-16">

            {{-- Left: Hamburger + Breadcrumb --}}
            <div class="flex items-center gap-4">
                {{-- Hamburger (mobile) --}}
                <button id="open-sidebar"
                        class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- Page Title / Breadcrumb --}}
                <div>
                    <h1 class="text-base font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    @hasSection('breadcrumb')
                        <p class="text-xs text-gray-400">@yield('breadcrumb')</p>
                    @endif
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-3">

                {{-- View site button --}}
                <a href="{{ route('home') }}" target="_blank"
                   class="hidden sm:flex items-center gap-2 px-3 py-1.5 text-xs text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat Website
                </a>

                {{-- User avatar dropdown --}}
                <div class="relative" id="user-menu-container">
                    <button id="user-menu-btn"
                            class="flex items-center gap-2 p-1 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    {{-- Dropdown --}}
                    <div id="user-menu"
                         class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    {{-- FLASH MESSAGES --}}
    @if (session('success') || session('error') || session('info'))
        <div class="px-6 pt-4">
            @if (session('success'))
                <div class="flash-msg flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm mb-2">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="flash-msg flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm mb-2">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="flash-msg flex items-start gap-3 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl px-4 py-3 text-sm mb-2">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('info') }}
                </div>
            @endif
        </div>
    @endif

    {{-- PAGE CONTENT --}}
    <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="px-6 py-3 border-t border-gray-100 text-center">
        <p class="text-xs text-gray-400">
            Ruang Belajar Admin Panel &copy; {{ date('Y') }}
        </p>
    </footer>

</div>

{{-- ===================== SCRIPTS ===================== --}}
<script>
    // ---- Mobile Sidebar Toggle ----
    const sidebar         = document.getElementById('sidebar');
    const overlay         = document.getElementById('sidebar-overlay');
    const openSidebarBtn  = document.getElementById('open-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
        document.body.classList.add('overflow-hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        overlay.classList.remove('opacity-100');
        document.body.classList.remove('overflow-hidden');
    }

    openSidebarBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);

    // ---- User Menu Dropdown ----
    const userMenuBtn       = document.getElementById('user-menu-btn');
    const userMenu          = document.getElementById('user-menu');
    const userMenuContainer = document.getElementById('user-menu-container');

    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!userMenuContainer.contains(e.target)) {
            userMenu.classList.add('hidden');
        }
    });

    // ---- Auto-dismiss flash messages after 4s ----
    setTimeout(() => {
        document.querySelectorAll('.flash-msg').forEach(el => {
            el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-4px)';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>

@stack('scripts')
</body>
</html>
