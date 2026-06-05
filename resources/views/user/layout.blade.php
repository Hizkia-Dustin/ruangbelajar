@php
use App\Models\Setting;
$siteName     = Setting::get('website_name', 'Ruang Belajar');
$siteTagline  = Setting::get('website_tagline', 'Platform Edukasi Masa Kini');
$faviconPath  = Setting::get('favicon');
$canonicalUrl = rtrim(Setting::get('canonical_url', config('app.url')), '/');
$currentUrl   = $canonicalUrl . request()->getPathInfo();
$websiteLogo  = Setting::get('website_logo');
// SEO per halaman
$currentPage  = trim(request()->getPathInfo(), '/') ?: 'home';
$pageKey      = str_replace('/', '_', $currentPage);
$metaTitle    = Setting::get("{$pageKey}_meta_title") ?: (Setting::get('default_meta_title') ?: ($siteName . ' | ' . $siteTagline));
$metaDesc     = Setting::get("{$pageKey}_meta_description") ?: Setting::get('default_meta_description', 'Bimbingan belajar modern untuk melahirkan pribadi cerdas.');
$metaKeywords = Setting::get("{$pageKey}_meta_keywords") ?: Setting::get('default_meta_keywords', 'bimbel bogor, les privat');
$ogImage      = Setting::get("{$pageKey}_og_image") ?: Setting::get('og_image');
$ogImageUrl   = $ogImage ? asset('storage/'.$ogImage) : asset('images/og-default.jpg');
$ogTitle      = Setting::get('og_title') ?: $metaTitle;
$ogDesc       = Setting::get('og_description') ?: $metaDesc;
$twitterCard  = Setting::get('twitter_card_type', 'summary_large_image');
$robotsIndex  = Setting::get('robots_index', 'index');
$robotsFollow = Setting::get('robots_follow', 'follow');
$gaId         = Setting::get('google_analytics');
$fbPixelId    = Setting::get('facebook_pixel');
$headScript   = Setting::get('custom_head_script');
$bodyScript   = Setting::get('custom_body_script');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ===== TITLE ===== --}}
    <title>@yield('meta_title', $metaTitle)</title>

    {{-- ===== SEO META ===== --}}
    <meta name="description"   content="@yield('meta_description', $metaDesc)">
    <meta name="keywords"      content="@yield('meta_keywords', $metaKeywords)">
    <meta name="robots"        content="{{ $robotsIndex }}, {{ $robotsFollow }}">
    <link rel="canonical"      href="@yield('canonical', $currentUrl)">

    {{-- ===== OPEN GRAPH ===== --}}
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="{{ $siteName }}">
    <meta property="og:title"       content="@yield('og_title', $ogTitle)">
    <meta property="og:description" content="@yield('og_description', $ogDesc)">
    <meta property="og:image"       content="@yield('og_image', $ogImageUrl)">
    <meta property="og:url"         content="@yield('canonical', $currentUrl)">

    {{-- ===== TWITTER CARD ===== --}}
    <meta name="twitter:card"        content="{{ $twitterCard }}">
    <meta name="twitter:title"       content="@yield('og_title', $ogTitle)">
    <meta name="twitter:description" content="@yield('og_description', $ogDesc)">
    <meta name="twitter:image"       content="@yield('og_image', $ogImageUrl)">

    {{-- ===== FAVICON ===== --}}
    @if($faviconPath)
    <link rel="icon" href="{{ asset('storage/'.$faviconPath) }}">
    @else
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    {{-- ===== GOOGLE ANALYTICS ===== --}}
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $gaId }}');</script>
    @endif

    {{-- ===== FACEBOOK PIXEL ===== --}}
    @if($fbPixelId)
    <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','{{ $fbPixelId }}');fbq('track','PageView');</script>
    @endif

    {{-- ===== CUSTOM HEAD SCRIPT ===== --}}
    @if($headScript) {!! $headScript !!} @endif

    {{-- ===== EXTRA HEAD ===== --}}
    @stack('head')

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                        secondary: '#FACC15',
                        brand: {
                            blue: '#2563EB',
                            darkBlue: '#1E40AF',
                            deepBlue: '#1E3A8A',
                            yellow: '#FACC15',
                            dark: '#0F172A',
                            light: '#F8FAFC'
                        }
                    },
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }
        .text-inter { font-family: 'Inter', sans-serif; }
        .gradient-blue {
            background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        }
        .gradient-light-blue {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        }
        .nav-link-active {
            color: #2563EB;
            position: relative;
        }
        .nav-link-active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #FACC15;
            border-radius: 4px;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .card-modern {
            @apply transition-all duration-500 hover:-translate-y-3 hover:shadow-[0_40px_80px_rgba(30,58,138,0.15)] bg-white border border-blue-50;
        }
        .btn-modern {
            @apply transition-all duration-300 hover:scale-[1.03] active:scale-95 shadow-xl hover:shadow-2xl;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .hover-rotate {
            @apply transition-transform duration-500 hover:rotate-12;
        }
        input, select, textarea {
            @apply transition-all duration-300 focus:ring-8 focus:ring-primary/5 focus:border-primary border-slate-200 outline-none !important;
        }
        button, .btn-primary, [href*="register"], [href*="wa.me"] {
            @apply transition-all duration-300 hover:scale-[1.03] active:scale-95 !important;
        }
        .group:hover .group-hover-rotate {
            @apply rotate-12 transition-transform duration-500;
        }
    </style>
</head>
<body class="bg-gray-50 text-brand-dark antialiased">

{{-- Custom body script --}}
@if($bodyScript) {!! $bodyScript !!} @endif


    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-xl shadow-lg shadow-blue-900/5 z-50 transition-all duration-500 border-b border-blue-50/50" id="navbar">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center h-full py-1">
                @if($websiteLogo)
                    <img src="{{ asset('storage/' . $websiteLogo) }}" alt="{{ $siteName }} Logo" class="h-full max-h-[60px] w-auto object-contain hover:scale-105 transition-transform duration-300">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Ruang Belajar Logo" class="h-full max-h-[60px] w-auto object-contain hover:scale-105 transition-transform duration-300">
                @endif
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-10">
                <a href="{{ url('/') }}" class="text-slate-600 font-semibold transition-all hover:text-primary {{ Request::is('/') ? 'nav-link-active text-primary' : '' }}">Beranda</a>
                <a href="{{ url('/about') }}" class="text-slate-600 font-semibold transition-all hover:text-primary {{ Request::is('about') ? 'nav-link-active text-primary' : '' }}">Tentang Kami</a>
                <a href="{{ url('/program') }}" class="text-slate-600 font-semibold transition-all hover:text-primary {{ Request::is('program') ? 'nav-link-active text-primary' : '' }}">Program</a>
                <a href="{{ url('/contact') }}" class="text-slate-600 font-semibold transition-all hover:text-primary {{ Request::is('contact') ? 'nav-link-active text-primary' : '' }}">Kontak</a>
            </div>

            <div class="hidden lg:flex items-center gap-6">
                <a href="{{ url('/register') }}" class="bg-secondary text-brand-dark px-8 py-3 rounded-full font-black hover:bg-yellow-300 transition-all shadow-lg shadow-yellow-200 active:scale-95 uppercase text-xs tracking-widest">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="lg:hidden text-slate-800 focus:outline-none" id="menu-toggle">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden bg-white border-b border-blue-50 hidden p-6 space-y-4" id="mobile-menu">
            <a href="{{ url('/') }}" class="block text-slate-600 font-bold">Beranda</a>
            <a href="{{ url('/about') }}" class="block text-slate-600 font-bold">Tentang Kami</a>
            <a href="{{ url('/program') }}" class="block text-slate-600 font-bold">Program</a>
            <a href="{{ url('/contact') }}" class="block text-slate-600 font-bold">Kontak</a>
            <a href="{{ url('/register') }}" class="block text-center bg-secondary text-brand-dark py-4 rounded-xl font-black uppercase tracking-widest text-sm shadow-lg shadow-yellow-200">Daftar Sekarang</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    <!-- Footer (Dinamis) -->
    @php
        $footerData = \App\Models\FooterSetting::getInstance();
        $footerSocials = \App\Models\SocialMedia::active()->get();
        $footerWa = \Illuminate\Support\Facades\DB::table('settings')
            ->where('key', 'contact_whatsapp')
            ->orWhere('key', 'contact_cta_whatsapp_number')
            ->orderByRaw("CASE WHEN `key`='contact_whatsapp' THEN 0 ELSE 1 END")
            ->value('value') ?? '6283157112597';
        $footerAlamat = $footerData->address ?? \Illuminate\Support\Facades\DB::table('settings')->where('key','contact_location_address')->value('value') ?? 'Tajur, Bogor Selatan, Kota Bogor, Jawa Barat';
        $footerPhone = $footerData->phone ?? '0831-5711-2597';
    @endphp
    <footer class="bg-brand-deepBlue text-white pt-24 pb-12 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-[50%] h-[100%] bg-blue-500/10 blur-[120px] rounded-full -rotate-45"></div>
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20 relative z-10">
            {{-- Brand + Deskripsi --}}
            <div>
                <h4 class="font-black text-white mb-8 italic uppercase tracking-widest text-sm">{{ $footerData->brand_name ?? 'Ruang Belajar' }}</h4>
                <p class="text-blue-200 font-medium leading-relaxed mb-8 opacity-80">
                    {{ $footerData->footer_description ?? $footerData->description ?? 'Bimbingan belajar modern untuk melahirkan pribadi yang cerdas, inovatif, dan siap menghadapi masa depan yang kompetitif.' }}
                </p>
                {{-- Sosial Media Dinamis --}}
                <div class="flex gap-4 flex-wrap">
                    @forelse($footerSocials as $social)
                    <a href="{{ $social->url }}" target="_blank"
                       class="w-10 h-10 bg-white/10 shadow-sm border border-white/5 rounded-full flex items-center justify-center text-secondary hover:bg-secondary hover:text-brand-dark transition-all">
                        <i class="{{ $social->auto_icon }}"></i>
                    </a>
                    @empty
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-secondary"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-secondary"><i class="fab fa-whatsapp"></i></a>
                    @endforelse
                </div>
            </div>

            {{-- Program --}}
            <div>
                <h4 class="font-black text-white mb-8 italic uppercase tracking-widest text-sm">Program Kami</h4>
                <ul class="flex flex-col gap-4 text-blue-100 font-medium opacity-70">
                    <li><a href="{{ url('/program') }}" class="hover:text-secondary transition-colors italic">Pra-TK Special</a></li>
                    <li><a href="{{ url('/program') }}" class="hover:text-secondary transition-colors italic">TK Full-Fun</a></li>
                    <li><a href="{{ url('/program') }}" class="hover:text-secondary transition-colors italic">SD Achievement</a></li>
                </ul>
            </div>

            {{-- Navigasi --}}
            <div>
                <h4 class="font-black text-white mb-8 italic uppercase tracking-widest text-sm">Navigasi</h4>
                <ul class="flex flex-col gap-4 text-blue-100 font-medium opacity-70">
                    <li><a href="{{ url('/') }}" class="hover:text-secondary transition-colors italic uppercase text-xs">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-secondary transition-colors italic uppercase text-xs">About</a></li>
                    <li><a href="{{ url('/program') }}" class="hover:text-secondary transition-colors italic uppercase text-xs">Program</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-secondary transition-colors italic uppercase text-xs">Contact</a></li>
                    <li><a href="{{ url('/register') }}" class="hover:text-secondary transition-colors italic uppercase text-xs">Daftar</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="font-black text-white mb-8 italic uppercase tracking-widest text-sm">Pusat Bantuan</h4>
                <ul class="flex flex-col gap-6 text-blue-100 font-medium text-xs">
                    <li class="flex items-start gap-4 italic">
                        <div class="w-8 h-8 rounded-lg bg-white/10 text-secondary flex items-center justify-center shrink-0 border border-white/5"><i class="fas fa-map-marker-alt"></i></div>
                        <span>{{ $footerAlamat }}</span>
                    </li>
                    <li class="flex items-center gap-4 italic">
                        <div class="w-8 h-8 rounded-lg bg-white/10 text-secondary flex items-center justify-center shrink-0 border border-white/5"><i class="fab fa-whatsapp"></i></div>
                        <a href="https://wa.me/{{ preg_replace('/\D/','',$footerWa) }}" class="hover:text-secondary transition">{{ $footerPhone }}</a>
                    </li>
                    @if($footerData->email)
                    <li class="flex items-center gap-4 italic">
                        <div class="w-8 h-8 rounded-lg bg-white/10 text-secondary flex items-center justify-center shrink-0 border border-white/5"><i class="fas fa-envelope"></i></div>
                        <span>{{ $footerData->email }}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-10 border-t border-white/10 text-center text-blue-300 text-xs font-black uppercase tracking-[0.2em] relative z-10">
            {{ $footerData->copyright_text ?? '© ' . date('Y') . ' Ruang Belajar. Seluruh Hak Cipta Dilindungi.' }}
        </div>
    </footer>

    {{-- Floating WhatsApp Button (dinamis) --}}
    @php
        $waFloatingStatus = \App\Models\Setting::get('wa_floating_status', '1');
        $waFloatingNumRaw = \App\Models\Setting::get('wa_floating_number', $footerWa);
        $waFloatingNum = preg_replace('/\D/', '', $waFloatingNumRaw);
        if (str_starts_with($waFloatingNum, '0')) {
            $waFloatingNum = '62' . substr($waFloatingNum, 1);
        }
        $waFloatingMsg = \App\Models\Setting::get('wa_floating_message', '');
        $waFloatingUrl = "https://wa.me/" . $waFloatingNum;
        if (!empty($waFloatingMsg)) {
            $waFloatingUrl .= "?text=" . urlencode($waFloatingMsg);
        }
    @endphp

    @if($waFloatingStatus == '1')
    <a href="{{ $waFloatingUrl }}"
       target="_blank"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg shadow-green-500/40 flex items-center justify-center text-2xl transition-all hover:scale-110 active:scale-95"
       title="Chat WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    @endif

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({
            duration: 1200,
            once: true,
            easing: 'ease-out-back'
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('py-1', 'shadow-2xl', 'shadow-blue-900/10');
            } else {
                nav.classList.remove('py-1', 'shadow-2xl', 'shadow-blue-900/10');
            }
        });
    </script>
</body>
</html>
