@extends('user.layout')

@section('title', 'Hubungi Kami')

@section('content')

@php
    // Fallback variables for Hero
    $heroBadge = !empty($settings['contact_hero_badge_text']) ? $settings['contact_hero_badge_text'] : 'PELAYANAN SEPENUH HATI';
    $heroTitle = !empty($settings['contact_hero_title_line_1']) ? $settings['contact_hero_title_line_1'] : 'Kami Siap';
    $heroHighlight = !empty($settings['contact_hero_title_highlight']) ? $settings['contact_hero_title_highlight'] : 'Mendengarkan.';
    $heroDesc = !empty($settings['contact_hero_description']) ? $settings['contact_hero_description'] : 'Jangan biarkan kebingungan menghambat potensi anak Anda. Kami di sini untuk membimbing Anda memilih langkah terbaik.';
    $heroImage = !empty($settings['contact_hero_background_image']) ? $settings['contact_hero_background_image'] : '';
    $heroActive = true;

    // Fallback variables for FAQ & Konsultasi
    $faqBadge = !empty($settings['contact_faq_badge']) ? $settings['contact_faq_badge'] : 'Pertanyaan Umum';
    $faqTitle = !empty($settings['contact_faq_title']) ? $settings['contact_faq_title'] : 'Mungkin Anda';
    $faqHighlight = !empty($settings['contact_faq_highlight']) ? $settings['contact_faq_highlight'] : 'Bertanya.';
    $konsBadge = !empty($settings['contact_konsultasi_badge']) ? $settings['contact_konsultasi_badge'] : 'Respon Cepat';
    $konsTitle = !empty($settings['contact_konsultasi_title']) ? $settings['contact_konsultasi_title'] : 'Konsultasi';
    $konsHighlight = !empty($settings['contact_konsultasi_highlight']) ? $settings['contact_konsultasi_highlight'] : 'Gratis';
    $konsBtnText = !empty($settings['contact_konsultasi_button_text']) ? $settings['contact_konsultasi_button_text'] : 'Chat WhatsApp Sekarang';
    $konsDesc = !empty($settings['contact_konsultasi_description']) ? $settings['contact_konsultasi_description'] : 'Admin Standby 24/7';
    $waNumber = !empty($settings['contact_whatsapp_number']) ? $settings['contact_whatsapp_number'] : (!empty($settings['contact_whatsapp']) ? $settings['contact_whatsapp'] : '6283157112597');
    $waClean = preg_replace('/\D/', '', $waNumber);

    // Fallback variables for Informasi Kontak
    $infoTitle = !empty($settings['contact_info_section_title']) ? $settings['contact_info_section_title'] : 'Kunjungi';
    $infoHighlight = !empty($settings['contact_info_section_highlight']) ? $settings['contact_info_section_highlight'] : 'Rumah Belajar Kami.';
    $addrTitle = !empty($settings['contact_info_address_title']) ? $settings['contact_info_address_title'] : 'Lokasi Strategis';
    $addrText = !empty($settings['contact_info_address_text']) ? $settings['contact_info_address_text'] : (!empty($settings['contact_alamat']) ? $settings['contact_alamat'] : '');
    $emailTitle = !empty($settings['contact_info_email_title']) ? $settings['contact_info_email_title'] : 'Email Support';
    $emailText = !empty($settings['contact_info_email_text']) ? $settings['contact_info_email_text'] : (!empty($settings['contact_email']) ? $settings['contact_email'] : '');
    $waTitle = !empty($settings['contact_info_whatsapp_title']) ? $settings['contact_info_whatsapp_title'] : 'WhatsApp Admin';
    $waText = !empty($settings['contact_info_whatsapp_text']) ? $settings['contact_info_whatsapp_text'] : (!empty($settings['contact_whatsapp']) ? $settings['contact_whatsapp'] : '');
    $igTitle = !empty($settings['contact_info_instagram_title']) ? $settings['contact_info_instagram_title'] : 'Instagram Resmi';
    $igText = !empty($settings['contact_info_instagram_text']) ? $settings['contact_info_instagram_text'] : '';
    $opsTitle = !empty($settings['contact_info_operational_title']) ? $settings['contact_info_operational_title'] : 'Jam Operasional';
    $opsText = !empty($settings['contact_info_operational_text']) ? $settings['contact_info_operational_text'] : (!empty($settings['contact_jam_operasional']) ? $settings['contact_jam_operasional'] : '');

    // Maps
    $embedUrl = !empty($settings['contact_maps_embed_url']) ? $settings['contact_maps_embed_url'] : '';
    $latitude = !empty($settings['contact_maps_latitude']) ? $settings['contact_maps_latitude'] : '';
    $longitude = !empty($settings['contact_maps_longitude']) ? $settings['contact_maps_longitude'] : '';
    $mapsUrlSetting = !empty($settings['contact_maps_url']) ? $settings['contact_maps_url'] : '';

    $mapsEmbed = '';
    // Kalau ada latitude dan longitude, selalu prioritaskan generate iframe dari koordinat
    if (!empty($latitude) && !empty($longitude)) {
        $mapsEmbed = "https://www.google.com/maps?q={$latitude},{$longitude}&hl=id&z=15&output=embed";
    } elseif (!empty($embedUrl)) {
        // Cek jika embedUrl mengandung kata 'embed' atau 'output=embed'
        if (str_contains($embedUrl, 'embed') || str_contains($embedUrl, 'output=embed')) {
            $mapsEmbed = $embedUrl;
        }
    }

    $mapsLink = '';
    if (!empty($mapsUrlSetting)) {
        $mapsLink = $mapsUrlSetting;
    } elseif (!empty($embedUrl) && !str_contains($embedUrl, 'embed') && !str_contains($embedUrl, 'output=embed')) {
        // Jika embedUrl adalah link biasa, gunakan sebagai link Google Maps
        $mapsLink = $embedUrl;
    } elseif (!empty($latitude) && !empty($longitude)) {
        $mapsLink = "https://www.google.com/maps?q={$latitude},{$longitude}";
    }
@endphp

<!-- Header Section -->
@if($heroActive)
<section class="pt-48 pb-32 px-6 bg-brand-deepBlue text-white relative overflow-hidden"
         style="{{ $heroImage ? 'background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url(' . asset('storage/' . $heroImage) . '); background-size: cover; background-position: center;' : '' }}">
    <div class="absolute top-0 right-[-10%] w-[60%] h-[120%] bg-blue-500/10 blur-[150px] rounded-full rotate-45 animate-pulse-slow"></div>
    <div class="max-w-7xl mx-auto flex flex-col items-center text-center relative z-10" data-aos="fade-up">
        <span class="text-secondary font-black tracking-[0.5em] uppercase text-[10px] mb-8 block italic underline decoration-white/20 underline-offset-8">{{ $heroBadge }}</span>
        <h1 class="text-6xl md:text-9xl font-black mb-12 tracking-tighter italic uppercase leading-none">{{ $heroTitle }} <br /><span class="text-blue-400 italic">{{ $heroHighlight }}</span></h1>
        <p class="text-xl md:text-2xl text-blue-100 max-w-2xl font-medium leading-[2] italic opacity-80">
            {{ $heroDesc }}
        </p>
    </div>
</section>
@endif

<!-- Contact & FAQ Section -->
<section class="py-32 px-6 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">

        <!-- Priority WhatsApp Card -->
        <div data-aos="fade-right">
            <div class="bg-brand-deepBlue p-16 md:p-24 rounded-[6rem] text-white shadow-[0_60px_100px_rgba(30,58,138,0.2)] relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-400/10 blur-[100px] rounded-full group-hover:bg-blue-400/20 transition-all duration-1000"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-8 mb-12">
                        <div class="w-24 h-24 bg-white/10 border border-white/10 text-secondary rounded-[2.5rem] flex items-center justify-center text-5xl shadow-2xl transition-transform group-hover:rotate-12 duration-500">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="text-4xl font-black italic tracking-tighter uppercase leading-none mb-2">{{ $konsBadge }}</h4>
                            <p class="text-blue-300 font-bold text-xs uppercase tracking-widest italic opacity-80">{{ $konsDesc }}</p>
                        </div>
                    </div>
                    <h2 class="text-5xl md:text-6xl font-black mb-10 tracking-tighter italic uppercase leading-tight">
                        {{ $konsTitle }} <span class="text-secondary italic">{{ $konsHighlight }}</span> Via WhatsApp!
                    </h2>
                    
                    {{-- Benefit Checklist --}}
                    <div class="space-y-8 mb-16 border-t border-white/10 pt-12">
                        @forelse($ctaFeatures as $feature)
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">{{ $feature->feature_text }}</p>
                        </div>
                        @empty
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Bantu pilih program yang tepat sesuai umur anak.</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Info detail jadwal & biaya investasi belajar.</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Penjadwalan Trial Gratis (S&K Berlaku).</p>
                        </div>
                        @endforelse
                    </div>

                    <a href="https://wa.me/{{ $waClean }}" target="_blank"
                       class="w-full bg-secondary text-brand-dark py-10 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-yellow-400/30 hover:bg-white transition-all active:scale-[0.98] flex items-center justify-center gap-6 italic uppercase tracking-tighter group/btn">
                        {{ $konsBtnText }} <i class="fas fa-paper-plane text-xl transform group-hover/btn:-translate-y-2 group-hover/btn:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- FAQ Section (dinamis dengan accordion) -->
        <div data-aos="fade-left">
            <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic">{{ $faqBadge }}</span>
            <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-16 tracking-tighter italic uppercase leading-[1]">{{ $faqTitle }} <span class="text-brand-blue">{{ $faqHighlight }}</span></h2>

            <div class="space-y-6">
                @forelse($faqs as $i => $faq)
                <div class="border border-slate-100 rounded-[3.5rem] overflow-hidden hover:shadow-lg hover:shadow-blue-900/5 transition-all duration-500 group">
                    <button onclick="toggleFaq({{ $i }})"
                            class="w-full flex items-center justify-between gap-4 p-8 text-left">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-xs shadow-inner italic flex-shrink-0">Q</span>
                            <h4 class="text-xl font-black text-brand-dark italic uppercase tracking-tight group-hover:text-brand-blue transition-colors">{{ $faq->question }}</h4>
                        </div>
                        <svg id="faq-icon-{{ $i }}" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-answer-{{ $i }}" class="hidden px-8 pb-8">
                        <p class="text-slate-500 font-medium leading-relaxed italic opacity-80 pl-12 border-l-2 border-blue-50 ml-4">{{ $faq->answer }}</p>
                    </div>
                </div>
                @empty
                {{-- Fallback statis --}}
                <div class="p-10 bg-white border border-slate-100 rounded-[3.5rem]">
                    <h4 class="text-xl font-black text-brand-dark italic uppercase tracking-tight mb-4 flex items-center gap-4">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-xs italic">Q</span>
                        Apakah bisa trial gratis dulu?
                    </h4>
                    <p class="text-slate-500 font-medium leading-relaxed italic opacity-80 pl-12 border-l-2 border-blue-50 ml-4">Tentu! Kami menyediakan sesi trial gratis untuk calon siswa.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Maps & Location (dinamis) -->
<section class="py-32 bg-brand-light px-6 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div data-aos="fade-right">
            <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-12 tracking-tighter italic uppercase leading-[1]">{{ $infoTitle }} <span class="text-brand-blue">{{ $infoHighlight }}</span></h2>
            <div class="space-y-12">
                {{-- 1. LOKASI --}}
                @if($addrText)
                <div class="flex gap-10 items-start">
                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">{{ $addrTitle }}</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">{{ $addrText }}</p>
                    </div>
                </div>
                @endif

                {{-- 2. EMAIL --}}
                @if($emailText)
                <div class="flex gap-10 items-start">
                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">{{ $emailTitle }}</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">{{ $emailText }}</p>
                    </div>
                </div>
                @endif

                {{-- 3. WHATSAPP --}}
                @if($waText)
                <div class="flex gap-10 items-start">
                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">{{ $waTitle }}</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">{{ $waText }}</p>
                    </div>
                </div>
                @endif

                {{-- 4. INSTAGRAM --}}
                @if($igText)
                <div class="flex gap-10 items-start">
                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">{{ $igTitle }}</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">{{ $igText }}</p>
                    </div>
                </div>
                @endif

                {{-- 5. JAM OPERASIONAL --}}
                @if($opsText)
                <div class="flex gap-10 items-start">
                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">{{ $opsTitle }}</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">{{ $opsText }}</p>
                    </div>
                </div>
                @endif

                @if($socials->isNotEmpty())
                <div class="flex gap-4 flex-wrap pt-4">
                    @foreach($socials as $s)
                    <a href="{{ $s->url }}" target="_blank"
                       class="w-12 h-12 bg-white text-brand-blue rounded-2xl flex items-center justify-center hover:bg-primary hover:text-white transition shadow-md text-lg">
                        <i class="{{ $s->auto_icon }}"></i>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        
        {{-- Google Maps Embed --}}
        <div class="relative py-12" data-aos="fade-left">
            @if(!empty($mapsEmbed))
                <div class="w-full h-[600px] bg-slate-300 rounded-[6rem] overflow-hidden shadow-[0_60px_100px_rgba(0,0,0,0.1)] border-[12px] border-white relative group">
                    <iframe src="{{ $mapsEmbed }}" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="grayscale group-hover:grayscale-0 transition-all duration-1000 saturate-[1.5]"></iframe>
                    <div class="absolute inset-x-0 bottom-0 p-12 bg-gradient-to-t from-brand-deepBlue/90 via-transparent to-transparent opacity-100 group-hover:opacity-0 transition-opacity duration-1000 text-white flex flex-col justify-end">
                        <p class="font-black text-4xl italic uppercase tracking-tighter mb-2">Rumah Belajar</p>
                        <p class="font-bold text-xs uppercase tracking-[0.3em] italic text-secondary">Lebih dekat dengan prestasi anak.</p>
                    </div>
                </div>
                
                @if(!empty($mapsLink))
                <div class="mt-6 text-center">
                    <a href="{{ $mapsLink }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl text-sm font-black uppercase tracking-wider hover:bg-primary transition shadow-md hover:-translate-y-0.5 transform">
                        <i class="fas fa-map-marked-alt text-secondary"></i> Buka di Google Maps
                    </a>
                </div>
                @endif
            @else
                <div class="w-full h-[300px] bg-slate-100 rounded-[3.5rem] border-4 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 p-8 text-center">
                    <div class="text-4xl mb-3">📍</div>
                    <p class="font-black text-xl italic uppercase tracking-tighter text-slate-500">Peta belum tersedia</p>
                    <p class="text-xs text-slate-400 mt-1">Gunakan alamat atau koordinat untuk menemukan lokasi kami.</p>
                </div>
                
                @if(!empty($mapsLink))
                <div class="mt-6 text-center">
                    <a href="{{ $mapsLink }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl text-sm font-black uppercase tracking-wider hover:bg-primary transition shadow-md hover:-translate-y-0.5 transform">
                        <i class="fas fa-map-marked-alt text-secondary"></i> Buka di Google Maps
                    </a>
                </div>
                @endif
            @endif
        </div>
    </div>
</section>

@endsection

<script>
function toggleFaq(i) {
    const answer = document.getElementById('faq-answer-'+i);
    const icon   = document.getElementById('faq-icon-'+i);
    if (answer) { answer.classList.toggle('hidden'); }
    if (icon)   { icon.classList.toggle('rotate-180'); }
}
</script>
