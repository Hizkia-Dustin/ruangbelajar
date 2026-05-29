<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Login Admin — Ruang Belajar CMS" />
    <title>Login Admin — Ruang Belajar</title>

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
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        accent: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; 
        }
        .bg-light-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1.2px, transparent 1.2px);
            background-size: 24px 24px;
        }
        #remember:checked + div {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        #remember:checked + div .check-icon {
            display: block;
        }
    </style>
</head>
<body class="h-full bg-light-pattern text-slate-800 antialiased selection:bg-blue-500 selection:text-white">

<div class="min-h-screen bg-gradient-to-br from-blue-50/50 via-white to-indigo-50/50 flex items-center justify-center p-4 md:p-8 relative overflow-hidden">
    
    {{-- Decorative Background Blobs --}}
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl pointer-events-none animate-pulse duration-[6000ms]"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-300/20 rounded-full blur-3xl pointer-events-none animate-pulse duration-[8000ms]"></div>

    {{-- Main Container Card --}}
    <div class="relative w-full max-w-5xl bg-white/80 backdrop-blur-md rounded-[2rem] shadow-[0_20px_50px_rgba(59,130,246,0.08)] border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[600px] z-10">
        
        {{-- Left Section: Branding --}}
        <div class="lg:col-span-5 flex flex-col justify-between relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 p-8 lg:p-12 min-h-[220px] lg:min-h-full">
            {{-- Ambient lights inside left section --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-indigo-500/30 rounded-full blur-xl pointer-events-none"></div>
            
            {{-- Decorative orbits/circles matching "Ruang Belajar" concept --}}
            <div class="absolute top-1/3 left-1/2 w-48 h-48 border border-white/5 rounded-full pointer-events-none hidden lg:block animate-[spin_60s_linear_infinite]">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 bg-yellow-400 rounded-full shadow-lg shadow-yellow-400/50"></div>
            </div>
            <div class="absolute top-1/4 left-10 w-28 h-28 border border-white/10 border-dashed rounded-full pointer-events-none hidden lg:block animate-[spin_40s_linear_infinite]"></div>

            <div class="relative z-10 flex flex-col justify-between h-full">
                {{-- Top: Logo and Brand --}}
                <div class="flex items-center gap-3 lg:block">
                    <div class="inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg mb-0 lg:mb-6">
                        <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="lg:hidden">
                        <h1 class="text-xl font-bold text-white leading-none">Ruang Belajar</h1>
                        <span class="text-xs text-blue-200">Admin Dashboard</span>
                    </div>
                </div>

                {{-- Bottom/Middle: Content --}}
                <div class="mt-6 lg:mt-auto">
                    <span class="hidden lg:inline-block px-3 py-1 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full text-xs font-semibold tracking-wider text-blue-100 mb-4">
                        ADMIN DASHBOARD
                    </span>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-white tracking-tight leading-tight">
                        Ruang Belajar <br class="hidden lg:inline" />Admin Panel
                    </h2>
                    <p class="text-blue-100/80 text-xs lg:text-sm mt-3 leading-relaxed max-w-sm">
                        Kelola konten website, pendaftaran, program, kontak, dan testimoni dari satu tempat.
                    </p>
                </div>
            </div>
        </div>

        {{-- Right Section: Login Form --}}
        <div class="lg:col-span-7 p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white">
            <div class="w-full max-w-md mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">Login Admin</h2>
                    <p class="text-slate-500 text-sm mt-1.5">Silakan masuk menggunakan akun administrator Anda.</p>
                </div>

                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl px-4 py-3 mb-6 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('info'))
                    <div class="flex items-center gap-3 bg-blue-50 border border-blue-100 text-blue-700 rounded-2xl px-4 py-3 mb-6 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('info') }}</span>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('admin.login.post') }}" id="login-form">
                    @csrf

                    {{-- Email Field --}}
                    <div class="mb-5">
                        <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="admin@ruangbelajar.id"
                                required
                                autofocus
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 hover:bg-slate-100/70 focus:bg-white border rounded-2xl text-sm text-slate-800 placeholder-slate-400 outline-none transition-all duration-200 shadow-sm focus:shadow-md focus:ring-4 focus:ring-blue-500/10
                                       {{ $errors->has('email') ? 'border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500' }}"
                            />
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-6">
                        <label for="password" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                class="w-full pl-11 pr-12 py-3 bg-slate-50 hover:bg-slate-100/70 focus:bg-white border rounded-2xl text-sm text-slate-800 placeholder-slate-400 outline-none transition-all duration-200 shadow-sm focus:shadow-md focus:ring-4 focus:ring-blue-500/10
                                       {{ $errors->has('password') ? 'border-red-400 bg-red-50/50 focus:border-red-500 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500' }}"
                            />
                            {{-- Toggle show/hide password --}}
                            <button type="button" id="toggle-password"
                                    class="absolute right-3 inset-y-0 flex items-center pr-4 text-slate-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Remember Me Checkbox --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer select-none">
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    class="sr-only"
                                    {{ old('remember') ? 'checked' : '' }}
                                />
                                <div class="w-5 h-5 bg-slate-50 border border-slate-200 rounded-md transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-white stroke-2 fill-none hidden check-icon" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <span class="ml-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">
                                Ingat saya di perangkat ini
                            </span>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        id="login-btn"
                        class="w-full py-3.5 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-2xl text-sm shadow-lg shadow-blue-500/10 hover:shadow-xl hover:shadow-blue-500/20 active:scale-[0.98] transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-100 flex items-center justify-center cursor-pointer"
                    >
                        <span id="btn-text">Masuk ke Dashboard</span>
                        <span id="btn-loading" class="hidden items-center justify-center gap-2">
                            <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </form>

                {{-- Back to site --}}
                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Website Utama
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Toggle show/hide password
    const toggleBtn = document.getElementById('toggle-password');
    const pwdInput  = document.getElementById('password');
    const eyeIcon   = document.getElementById('eye-icon');

    toggleBtn.addEventListener('click', () => {
        const isHidden = pwdInput.type === 'password';
        pwdInput.type  = isHidden ? 'text' : 'password';
        eyeIcon.innerHTML = isHidden
            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    });

    // Loading state saat submit
    document.getElementById('login-form').addEventListener('submit', function () {
        const btn     = document.getElementById('login-btn');
        const text    = document.getElementById('btn-text');
        const loading = document.getElementById('btn-loading');
        btn.disabled  = true;
        text.classList.add('hidden');
        loading.classList.remove('hidden');
        loading.classList.add('flex');
    });
</script>

</body>
</html>
