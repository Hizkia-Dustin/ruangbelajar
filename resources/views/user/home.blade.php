@extends('user.layout')

@section('title', 'Beranda')

@section('content')

<!-- Hero Section -->
<section class="min-h-screen flex items-center bg-brand-deepBlue relative overflow-hidden px-6 lg:px-20 py-24 text-white">
    <!-- Background Decor -->
    <div class="absolute top-[10%] right-[-10%] w-[60%] h-[60%] bg-blue-500/20 rounded-full blur-[140px] animate-pulse"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[40%] bg-blue-600/10 rounded-full blur-[120px]"></div>
    
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-24 items-center relative z-10">
        <!-- Text Content -->
        <div data-aos="fade-right">
            <div class="inline-flex items-center gap-4 bg-white/10 backdrop-blur-xl border border-white/10 px-6 py-3 rounded-full mb-12 shadow-2xl flex-nowrap">
                <span class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-brand-dark transition-transform hover:rotate-12 duration-500"><i class="fas fa-bolt text-sm"></i></span>
                <span class="text-white font-black text-xs tracking-[0.2em] uppercase italic opacity-90">{{ $homeSetting->badge_text }}</span>
            </div>
            
            <h1 class="text-5xl md:text-8xl font-black leading-[0.95] tracking-tight mb-12 italic uppercase">
                {{ $homeSetting->title }} <br />
                <span class="bg-secondary text-brand-dark px-6 py-2 rounded-[2rem] inline-block mt-4 mb-4 transform -rotate-1 shadow-2xl shadow-yellow-400/20">{{ $homeSetting->highlighted_title }}</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 font-medium leading-[1.8] mb-20 max-w-xl opacity-80 italic">
                {{ $homeSetting->description }}
            </p>
            
            <div class="flex flex-col sm:flex-row gap-8">
                <a href="{{ $homeSetting->button_link ?? url('/register') }}" class="bg-white text-brand-deepBlue px-14 py-7 rounded-[3rem] font-black text-2xl hover:bg-secondary hover:text-brand-dark transition-all shadow-2xl shadow-white/5 active:scale-95 text-center flex items-center justify-center gap-4 group italic uppercase tracking-tighter">
                    {{ $homeSetting->button_text ?? 'Daftar Program' }} <i class="fas fa-chevron-right transition-transform group-hover:translate-x-3"></i>
                </a>
                <a href="https://wa.me/6283157112597" target="_blank" class="bg-blue-600/20 border-2 border-white/20 text-white px-14 py-7 rounded-[3rem] font-black text-2xl hover:bg-white hover:text-brand-dark transition-all active:scale-95 text-center flex items-center justify-center gap-4 group italic uppercase tracking-tighter">
                    <i class="fab fa-whatsapp text-3xl"></i> Konsultasi
                </a>
            </div>
        </div>
        
        <!-- Illustration Content -->
        <div class="relative lg:block" data-aos="zoom-in" data-aos-delay="200">
             <div class="relative z-10 w-full aspect-[4/3] max-h-[550px] rounded-[5rem] overflow-hidden shadow-[0_50px_100px_rgba(30,58,138,0.5)] border-8 border-white/5 group transition-transform duration-1000 hover:scale-[1.02]">
                <img src="{{ $homeSetting->hero_image ? asset('storage/'.$homeSetting->hero_image) : asset('images/hero.png') }}" alt="Education Hero" class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-1000 saturate-[1.2]">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-deepBlue/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-16 left-16 p-8 bg-white/10 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] max-w-xs transform group-hover:-translate-y-4 transition-transform duration-700">
                    <p class="font-black text-2xl italic tracking-tight mb-2">#EduInnovation</p>
                    <p class="font-bold text-xs opacity-80 uppercase tracking-widest italic leading-relaxed">Menciptakan Standar Baru Dalam Dunia Pendidikan.</p>
                </div>
             </div>
             <!-- Decorative elements -->
             <div class="absolute -top-10 -right-10 w-44 h-44 border-4 border-secondary/20 rounded-full animate-pulse"></div>
             <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 blur-3xl rounded-full"></div>
        </div>
    </div>
</section>

<!-- Trust Section -->
<section class="py-32 bg-brand-light relative z-20 overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-blue-100/30 blur-[150px] rounded-full"></div>
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
        <div class="bg-white p-16 rounded-[4.5rem] text-center shadow-2xl shadow-blue-900/5 group hover:bg-brand-deepBlue transition-all duration-700 border border-blue-50" data-aos="fade-up">
            <div class="w-20 h-20 bg-blue-50 text-brand-blue rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 text-3xl transition-transform group-hover:rotate-12 duration-500 shadow-inner group-hover:bg-white group-hover:text-brand-deepBlue">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="text-6xl font-black text-brand-dark mb-4 italic tracking-tighter uppercase group-hover:text-white"><span class="count-up" data-target="{{ $homeSetting->total_students }}">0</span>+</div>
            <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px] italic group-hover:text-blue-200">Siswa Aktif</p>
        </div>
        <div class="bg-white p-16 rounded-[4.5rem] text-center shadow-2xl shadow-blue-900/5 group hover:bg-brand-deepBlue transition-all duration-700 border border-blue-50" data-aos="fade-up" data-aos-delay="200">
            <div class="w-20 h-20 bg-blue-50 text-brand-blue rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 text-3xl transition-transform group-hover:-rotate-12 duration-500 shadow-inner group-hover:bg-white group-hover:text-brand-deepBlue">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="text-6xl font-black text-brand-dark mb-4 italic tracking-tighter uppercase group-hover:text-white"><span class="count-up" data-target="{{ $homeSetting->total_tutors }}">0</span>+</div>
            <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px] italic group-hover:text-blue-200">Tutor Profesional</p>
        </div>
        <div class="bg-white p-16 rounded-[4.5rem] text-center shadow-2xl shadow-blue-900/5 group hover:bg-brand-deepBlue transition-all duration-700 border border-blue-50" data-aos="fade-up" data-aos-delay="400">
            <div class="w-20 h-20 bg-blue-50 text-brand-blue rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 text-3xl transition-transform group-hover:rotate-12 duration-500 shadow-inner group-hover:bg-white group-hover:text-brand-deepBlue">
                <i class="fas fa-rocket"></i>
            </div>
            <div class="text-6xl font-black text-brand-dark mb-4 italic tracking-tighter uppercase group-hover:text-white"><span class="count-up" data-target="{{ $homeSetting->total_programs }}">0</span></div>
            <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px] italic group-hover:text-blue-200">Program Belajar</p>
        </div>
    </div>
</section>

@php
    $displaySolSmallLabel = $solutionSetting->small_label ?? 'THE SOLUTION';
    $displaySolTitle1 = $solutionSetting->title_line_1 ?? 'Ubah';
    $displaySolTitleHighlight = $solutionSetting->title_highlight ?? 'Kebingungan';
    $displaySolTitle2 = $solutionSetting->title_line_2 ?? 'Menjadi';
    $displaySolTitleYellow = $solutionSetting->title_yellow ?? 'Kepercayaan Diri.';
    $displaySolDesc = $solutionSetting->description ?? 'Banyak siswa terjebak dalam metode hafalan yang membosankan. Ruang Belajar hadir membongkar metode konvensional tersebut dengan cara yang jauh lebih interaktif dan bermakna.';
    $displaySolImage = ($solutionSetting && $solutionSetting->image) ? asset('storage/'.$solutionSetting->image) : asset('images/solution.png');
    $displaySolActive = $solutionSetting ? $solutionSetting->is_active : true;
@endphp

@if($displaySolActive)
<!-- Problem & Solution Section -->
<section class="py-40 bg-white px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-24 items-center">
        <!-- Visual Comparison -->
        <div class="lg:w-1/2 relative" data-aos="fade-right">
            <div class="relative z-10 w-full aspect-[4/3] max-h-[500px] rounded-[5rem] overflow-hidden shadow-[0_50px_100px_rgba(0,0,0,0.1)] border-8 border-slate-50 group">
                <img src="{{ $displaySolImage }}" alt="Solution Comparison" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000">
                <div class="absolute inset-0 bg-blue-900/20 group-hover:bg-transparent transition-all duration-700"></div>
            </div>
            <!-- Labels -->
            <div class="absolute -top-10 -left-10 bg-brand-dark text-white p-8 rounded-[2.5rem] shadow-2xl z-20 border border-white/5 italic">
                <p class="text-xs uppercase font-black tracking-widest text-secondary mb-2">Masalah Umum</p>
                <p class="text-sm font-bold opacity-80">Pelajaran Terlalu Rumit?</p>
            </div>
            <div class="absolute -bottom-10 -right-10 bg-brand-blue text-white p-10 rounded-[3rem] shadow-2xl z-20 border border-white/10 italic animate-bounce-slow">
                <p class="text-xs uppercase font-black tracking-widest text-secondary mb-2">Solusi Kami</p>
                <p class="text-lg font-black uppercase tracking-tight">Belajar Enjoy & Paham!</p>
            </div>
        </div>
        
        <!-- Text Content -->
        <div class="lg:w-1/2" data-aos="fade-left">
            <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-xs mb-8 block italic underline decoration-blue-100 underline-offset-8">{{ $displaySolSmallLabel }}</span>
            <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-12 tracking-tighter italic uppercase leading-[1.05]">{{ $displaySolTitle1 }} <span class="text-brand-blue">{{ $displaySolTitleHighlight }}</span> {{ $displaySolTitle2 }} <span class="bg-secondary px-4 rounded-2xl">{{ $displaySolTitleYellow }}</span></h2>
            <p class="text-xl text-slate-500 font-medium leading-[2] mb-16 italic opacity-80">
                {{ $displaySolDesc }}
            </p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                @if(isset($solutionPoints) && $solutionPoints->isNotEmpty())
                    @foreach($solutionPoints as $point)
                    <div class="flex gap-6 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-1 shadow-sm"><i class="fas fa-check"></i></div>
                        <p class="text-slate-800 font-black text-sm uppercase italic tracking-wide">{{ $point->title }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="flex gap-6 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-1 shadow-sm"><i class="fas fa-check"></i></div>
                        <p class="text-slate-800 font-black text-sm uppercase italic tracking-wide">Tutor Asyik & Sabar</p>
                    </div>
                     <div class="flex gap-6 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-1 shadow-sm"><i class="fas fa-check"></i></div>
                        <p class="text-slate-800 font-black text-sm uppercase italic tracking-wide">Materi Per Jenjang</p>
                    </div>
                     <div class="flex gap-6 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-1 shadow-sm"><i class="fas fa-check"></i></div>
                        <p class="text-slate-800 font-black text-sm uppercase italic tracking-wide">Kuis Interaktif</p>
                    </div>
                     <div class="flex gap-6 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-1 shadow-sm"><i class="fas fa-check"></i></div>
                        <p class="text-slate-800 font-black text-sm uppercase italic tracking-wide">Progress Report</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Keunggulan Section (Dark) -->
<section class="py-40 bg-brand-dark text-white px-6 overflow-hidden relative">
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-600/10 blur-[150px] rounded-full"></div>
    <div class="max-w-7xl mx-auto relative z-10 text-center">
        <div class="mb-24" data-aos="fade-up">
            <span class="text-secondary font-black tracking-[0.4em] uppercase text-xs mb-8 block italic underline decoration-white/10 underline-offset-8">Our Values</span>
            <h2 class="text-5xl md:text-8xl font-black mb-10 tracking-tighter italic uppercase">Mengapa Kami <span class="text-secondary italic">Berbeda?</span></h2>
            <p class="text-blue-200 font-medium max-w-2xl mx-auto italic text-lg opacity-60">Komitmen kami adalah memberikan pengalaman belajar yang melampaui sekadar bangku sekolah.</p>
        </div>
        
        {{-- Keunggulan dinamis dari database --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            @forelse($keunggulans as $i => $item)
            <div class="bg-white/5 border border-white/5 p-16 rounded-[4.5rem] hover:bg-white/10 transition-all duration-700 group hover:-translate-y-4 hover:shadow-2xl hover:shadow-blue-500/10" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                <div class="w-24 h-24 bg-white/10 text-secondary rounded-[3rem] flex items-center justify-center text-4xl mx-auto mb-12 shadow-2xl group-hover:bg-secondary group-hover:text-brand-dark transition-all duration-500 transform group-hover:rotate-12">
                    <i class="{{ $item->display_icon }}"></i>
                </div>
                <h3 class="text-3xl font-black mb-6 italic tracking-tight uppercase">{{ $item->title }}</h3>
                <p class="text-blue-100/60 font-medium text-sm leading-relaxed italic">{{ $item->description }}</p>
            </div>
            @empty
            <div class="col-span-4 text-center text-blue-200/40 py-8">Belum ada keunggulan yang ditampilkan.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Program Section -->
<section class="py-40 bg-brand-light px-6 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div data-aos="fade-right">
             <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-xs mb-8 block italic">Program Belajar</span>
             <h2 class="text-5xl md:text-8xl font-black text-brand-dark mb-10 tracking-tighter italic uppercase leading-[1]">Pilihan <span class="bg-brand-blue text-white px-6 rounded-3xl transform rotate-2 inline-block py-2">Terbaik.</span></h2>
             <p class="text-xl text-slate-500 font-medium leading-[2] mb-12 italic opacity-80 max-w-lg">Kami menyediakan berbagai jenjang pembelajaran yang disesuaikan dengan kebutuhan putra-putri Anda.</p>
             <div class="flex flex-wrap gap-8 border-t border-blue-100 pt-10 mt-10">
                <div class="flex items-center gap-4">
                   <div class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shadow-sm"><i class="fas fa-graduation-cap"></i></div>
                   <div>
                      <p class="text-lg font-black text-brand-blue italic tracking-tighter leading-none">Jenjang</p>
                      <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest italic">Pra-TK, TK, SD</p>
                   </div>
                </div>
                <div class="flex items-center gap-4">
                   <div class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shadow-sm"><i class="fas fa-users text-sm"></i></div>
                   <div>
                      <p class="text-lg font-black text-brand-blue italic tracking-tighter leading-none">Personal</p>
                      <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest italic">Kelas Kecil</p>
                   </div>
                </div>
                <div class="flex items-center gap-4">
                   <div class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shadow-sm"><i class="fas fa-user-tie text-sm"></i></div>
                   <div>
                      <p class="text-lg font-black text-brand-blue italic tracking-tighter leading-none">Berpengalaman</p>
                      <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest italic">Tutor Ahli</p>
                   </div>
                </div>
             </div>
        </div>
        
        <div class="grid grid-cols-1 gap-12" data-aos="fade-left">
            @forelse($homeProgramCards as $card)
            <div onclick="window.location.href='{{ url('/program') }}'"
                 class="bg-white p-12 rounded-[4rem] group hover:bg-brand-blue transition-all duration-700 shadow-2xl shadow-blue-900/5 relative overflow-hidden cursor-pointer">
                <div class="absolute inset-0 bg-blue-600/10 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
                <div class="relative z-10 flex flex-col sm:flex-row items-center gap-10">
                    <div class="w-24 h-24 bg-brand-light text-brand-blue rounded-[2.5rem] flex items-center justify-center shrink-0 group-hover:bg-white group-hover:rotate-12 transition-all duration-500 text-3xl shadow-inner">
                        <i class="{{ $card->display_icon }}"></i>
                    </div>
                    <div>
                         @if($card->badge)
                             <div class="inline-block bg-yellow-400 text-brand-dark text-[8px] uppercase font-black tracking-widest px-3 py-1 rounded-full mb-4 group-hover:bg-white">{{ $card->badge }}</div>
                         @endif
                         <h3 class="text-4xl font-black text-brand-dark italic tracking-tight uppercase group-hover:text-white transition-colors duration-500 leading-none">{{ $card->title }}</h3>
                         <p class="text-slate-400 font-medium text-sm mt-4 italic group-hover:text-blue-100 transition-colors duration-500">{{ $card->description }}</p>
                    </div>
                    <div class="sm:ml-auto group-hover:translate-x-4 transition-transform duration-500">
                        <i class="fas fa-arrow-right text-brand-blue group-hover:text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-400 py-8">Belum ada card program.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-40 px-6 bg-white overflow-hidden relative">
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200 to-transparent"></div>
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-24" data-aos="fade-up">
            <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-xs mb-8 block italic underline decoration-blue-100 underline-offset-8">Wall of Love</span>
            <h2 class="text-5xl md:text-7xl font-black text-brand-dark tracking-tighter italic uppercase leading-[1]">Apa Kata Orang Tua?</h2>
        </div>
        
        <div class="relative group/slider max-w-7xl mx-auto px-4" data-aos="fade-up" id="home-testimonial-slider">
            <!-- Carousel Container -->
            <div class="overflow-hidden py-8">
                <div class="flex transition-transform duration-500 ease-out" id="testimonial-track">
                    @forelse($testimonials as $item)
                    <div class="w-full md:w-1/2 lg:w-1/4 shrink-0 px-4">
                        <div class="bg-brand-deepBlue p-8 md:p-10 lg:p-6 xl:p-8 rounded-[3rem] text-white shadow-2xl shadow-blue-900/20 relative group overflow-hidden flex flex-col justify-between h-full min-h-[380px] lg:min-h-[420px]">
                            <div class="absolute top-10 right-10 opacity-5 text-8xl group-hover:rotate-12 transition-transform duration-700 pointer-events-none"><i class="fas fa-quote-right"></i></div>
                            <div>
                                <div class="flex gap-2 text-secondary mb-8">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            <i class="fas fa-star text-sm"></i>
                                        @else
                                            <i class="far fa-star text-sm opacity-35"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-lg font-bold italic mb-8 leading-relaxed opacity-90 relative z-10">"{{ $item->testimonial }}"</p>
                            </div>
                            <div class="flex items-center gap-4 relative z-10 border-t border-white/10 pt-6 mt-auto">
                                <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/5 flex items-center justify-center text-lg text-secondary overflow-hidden shrink-0">
                                    @if($item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}" class="w-full h-full object-cover" alt="{{ $item->name }}">
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-black text-white italic text-base uppercase tracking-tight">{{ $item->name }}</p>
                                    <p class="text-[9px] text-blue-300 font-bold uppercase tracking-widest italic opacity-60">{{ $item->role }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="w-full text-center text-slate-400 py-8">Belum ada testimoni yang ditampilkan.</div>
                    @endforelse
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button id="btn-prev" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-8 w-14 h-14 bg-white text-brand-deepBlue border border-blue-100 rounded-full flex items-center justify-center shadow-xl hover:bg-brand-blue hover:text-white transition-all active:scale-95 z-30">
                <i class="fas fa-chevron-left text-base"></i>
            </button>
            <button id="btn-next" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-8 w-14 h-14 bg-white text-brand-deepBlue border border-blue-100 rounded-full flex items-center justify-center shadow-xl hover:bg-brand-blue hover:text-white transition-all active:scale-95 z-30">
                <i class="fas fa-chevron-right text-base"></i>
            </button>

            <!-- Dots Indicator -->
            <div class="flex justify-center gap-3 mt-10" id="slider-dots">
                <!-- Dots will be populated by JS -->
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section (Power Section) -->
<section class="py-24 px-6 relative bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="gradient-blue rounded-[6rem] p-16 md:p-32 text-center text-white overflow-hidden relative shadow-2xl shadow-blue-900/30 group" data-aos="zoom-in">
            <!-- Animated decorative elements -->
            <div class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-blue-400/10 via-transparent to-transparent opacity-50 group-hover:scale-110 transition-transform duration-1000"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <h2 class="text-5xl md:text-8xl font-black mb-12 leading-[1] tracking-tighter italic uppercase">Segera Amankan <br /> <span class="text-secondary italic">Kursi Belajar</span> Anak!</h2>
                <p class="text-2xl text-blue-100 font-medium mb-20 opacity-90 max-w-xl mx-auto italic">Kuota pendampingan terbatas setiap bulannya untuk menjaga kualitas 1-on-1 kami.</p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-10 items-center">
                    <a href="{{ url('/register') }}" class="bg-secondary text-brand-dark px-20 py-8 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-yellow-400/40 hover:bg-white hover:scale-105 transition-all active:scale-95 group flex items-center justify-center gap-6 italic uppercase tracking-tighter">
                        Daftar Sekarang <i class="fas fa-paper-plane text-xl transform group-hover:-translate-y-2 group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
                
                <div class="mt-20 flex flex-wrap justify-center gap-12 opacity-60">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-shield-alt text-secondary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Garansi Kualitas</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-headset text-secondary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Support Admin 24/7</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-smile text-secondary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Belajar Pasti Happy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Count Up Logic
    function initCountUp() {
        const stats = document.querySelectorAll('.count-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    let current = 0;
                    const duration = 2500;
                    const increment = target / (duration / 16);
                    
                    const updateCount = () => {
                        current += increment;
                        if (current < target) {
                            entry.target.innerText = Math.round(current);
                            requestAnimationFrame(updateCount);
                        } else {
                            entry.target.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        stats.forEach(s => observer.observe(s));
    }
    
    document.addEventListener('DOMContentLoaded', initCountUp);

    // Testimonial Slider Logic
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('home-testimonial-slider');
        if (!slider) return;

        const track = slider.querySelector('#testimonial-track');
        const slides = track.children;
        const btnPrev = slider.querySelector('#btn-prev');
        const btnNext = slider.querySelector('#btn-next');
        const dotsContainer = slider.querySelector('#slider-dots');

        let currentIndex = 0;
        let slidesToShow = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 768 ? 2 : 1);
        let maxIndex = Math.max(0, slides.length - slidesToShow);

        function updateSlider() {
            slidesToShow = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 768 ? 2 : 1);
            maxIndex = Math.max(0, slides.length - slidesToShow);

            // Sembunyikan navigasi jika jumlah slide <= jumlah yang ditampilkan
            if (slides.length <= slidesToShow) {
                btnPrev.classList.add('hidden');
                btnNext.classList.add('hidden');
                dotsContainer.classList.add('hidden');
            } else {
                btnPrev.classList.remove('hidden');
                btnNext.classList.remove('hidden');
                dotsContainer.classList.remove('hidden');
            }

            if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }

            // Translate track
            const translateValue = currentIndex * (100 / slidesToShow);
            track.style.transform = `translateX(-${translateValue}%)`;

            // Update Dots active state
            const dots = dotsContainer.children;
            for (let i = 0; i < dots.length; i++) {
                if (dots[i]) {
                    if (i === currentIndex) {
                        dots[i].classList.add('bg-brand-blue', 'w-8');
                        dots[i].classList.remove('bg-blue-200', 'w-3');
                    } else {
                        dots[i].classList.remove('bg-brand-blue', 'w-8');
                        dots[i].classList.add('bg-blue-200', 'w-3');
                    }
                }
            }

            // Disable buttons if at boundaries
            btnPrev.disabled = currentIndex === 0;
            btnPrev.style.opacity = currentIndex === 0 ? '0.5' : '1';
            btnPrev.style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';

            btnNext.disabled = currentIndex === maxIndex;
            btnNext.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
            btnNext.style.pointerEvents = currentIndex === maxIndex ? 'none' : 'auto';
        }

        function createDots() {
            dotsContainer.innerHTML = '';
            slidesToShow = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 768 ? 2 : 1);
            maxIndex = Math.max(0, slides.length - slidesToShow);
            
            // Hanya buat dots jika jumlah slide > yang ditampilkan
            if (slides.length > slidesToShow) {
                for (let i = 0; i <= maxIndex; i++) {
                    const dot = document.createElement('button');
                    dot.className = 'h-3 rounded-full transition-all duration-300 bg-blue-200 focus:outline-none';
                    dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                    dot.addEventListener('click', () => {
                        currentIndex = i;
                        updateSlider();
                    });
                    dotsContainer.appendChild(dot);
                }
            }
        }

        // Event listeners
        btnPrev.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        btnNext.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        // Handle touch/swipe gestures for mobile/tablet
        let startX = 0;
        let isSwiping = false;

        track.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isSwiping = true;
        });

        track.addEventListener('touchmove', (e) => {
            if (!isSwiping) return;
            const diffX = e.touches[0].clientX - startX;
            if (Math.abs(diffX) > 50) {
                if (diffX > 0 && currentIndex > 0) {
                    currentIndex--;
                    updateSlider();
                    isSwiping = false;
                } else if (diffX < 0 && currentIndex < maxIndex) {
                    currentIndex++;
                    updateSlider();
                    isSwiping = false;
                }
            }
        });

        track.addEventListener('touchend', () => {
            isSwiping = false;
        });

        // Resize handling
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const oldSlidesShow = slidesToShow;
                slidesToShow = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 768 ? 2 : 1);
                if (oldSlidesShow !== slidesToShow) {
                    createDots();
                    updateSlider();
                }
            }, 100);
        });

        // Initial setup
        createDots();
        updateSlider();
    });
</script>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
    .animate-bounce-slow { animation: bounce-slow 4s infinite ease-in-out; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
