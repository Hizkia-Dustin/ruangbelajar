@extends('user.layout')

@section('title', 'Program Belajar')

@section('content')

    <!-- Header Section -->
    <section class="pt-48 pb-32 px-6 bg-white relative overflow-hidden text-center border-b border-blue-50">
        <div class="absolute top-0 right-0 w-[50%] h-[100%] bg-blue-500/5 blur-[150px] rounded-full animate-pulse-slow">
        </div>
        <div class="max-w-7xl mx-auto flex flex-col items-center relative z-10" data-aos="fade-up">
            <span
                class="text-primary font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic underline decoration-blue-100 underline-offset-8">Pilihan
                Masa Depan</span>
            <h1 class="text-6xl md:text-9xl font-black text-slate-900 mb-12 tracking-tighter italic leading-none uppercase">
                Temukan <br /><span class="text-primary italic">Potensinya.</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 max-w-2xl font-medium leading-[2] italic opacity-80">
                Program bimbingan yang dirancang penuh kasih untuk membentuk karakter cerdas dan kepercayaan diri anak sejak
                dini.
            </p>
        </div>
    </section>

    <!-- Program Grid Section -->
    <section class="py-40 px-6 bg-brand-light relative overflow-hidden">
        <div
            class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 lg:gap-12 relative z-10 items-stretch">

            @forelse($programs as $program)
                @php
                    $isFeatured = $program->is_featured;
                    $img = $program->thumbnail ?: $program->image;
                    $ageRange = $program->age_range ?: $program->umur_target;
                    $desc = $program->description;
                    $btnText = $program->button_text ?: 'Tanya Program Ini';
                    $btnLink = $program->button_link ?: 'https://wa.me/6283157112597';
                    $badge = $program->badge_text;
                    $highlight = $program->highlights->first();
                @endphp

                @if($isFeatured)
                    {{-- FEATURED CARD --}}
                    <div class="bg-brand-deepBlue rounded-[6rem] border-8 border-white/5 p-16 md:p-20 shadow-[0_60px_100px_rgba(30,58,138,0.3)] transition-all duration-1000 scale-[1.08] lg:-translate-y-6 relative overflow-hidden flex flex-col z-20"
                        data-aos="zoom-in" data-aos-delay="200">
                        <div class="absolute top-10 right-10 flex flex-col items-end gap-2">
                            @if($badge)
                                <span
                                    class="bg-secondary text-brand-dark text-[10px] uppercase font-black tracking-[0.2em] px-6 py-3 rounded-full shadow-2xl animate-bounce italic">{{ $badge }}</span>
                            @endif
                            @if($ageRange)
                                <span
                                    class="bg-white/10 text-white text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full backdrop-blur-md italic">{{ $ageRange }}</span>
                            @endif
                        </div>
                        <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/20 blur-[120px] rounded-full"></div>

                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->display_title }}"
                                class="w-32 h-32 rounded-[3.5rem] object-cover mb-12 shadow-2xl">
                        @else
                            <div
                                class="w-32 h-32 bg-white/10 border border-white/10 text-secondary rounded-[3.5rem] flex items-center justify-center mb-12 shadow-2xl transition-transform duration-700 hover:-rotate-12">
                                <i class="{{ $program->display_icon }} text-5xl"></i>
                            </div>
                        @endif

                        <h3 class="text-5xl font-black text-white mb-8 italic uppercase tracking-tighter leading-none">
                            {{ $program->display_title }}
                        </h3>
                        <p class="text-blue-100 font-medium leading-[2] mb-12 text-sm opacity-90 italic text-justify">{{ $desc }}
                        </p>

                        @if($program->features->isNotEmpty())
                            <div class="space-y-5 mb-16 border-t border-white/10 pt-12 flex-grow">
                                @foreach($program->features->take(4) as $feature)
                                    <div
                                        class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest {{ $loop->first ? 'text-secondary' : 'text-white' }}">
                                        <i
                                            class="{{ $feature->icon ?? 'fas fa-check-circle' }} {{ !$loop->first ? 'text-secondary' : '' }}"></i>
                                        {{ $feature->feature_text }}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if($highlight)
                            <div class="mb-12 p-8 bg-white/5 rounded-3xl border border-white/10">
                                <p
                                    class="text-secondary text-[10px] font-black uppercase tracking-[0.2em] italic leading-none mb-4 flex items-center gap-3">
                                    <span class="w-8 h-[2px] bg-secondary rounded-full"></span> Value Utama
                                </p>
                                <p class="text-xl font-black text-white italic tracking-tighter uppercase leading-tight">
                                    {{ $highlight->title }}</p>
                            </div>
                        @endif

                        <a href="{{ $btnLink }}" target="_blank"
                            class="group/button block text-center bg-secondary text-brand-dark px-10 py-8 rounded-[3.5rem] font-black text-sm uppercase tracking-[0.2em] hover:bg-white hover:scale-105 transition-all duration-500 shadow-2xl shadow-yellow-400/30 mt-auto flex items-center justify-center gap-4">
                            {{ $btnText }} <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>

                @else
                    {{-- REGULAR CARD --}}
                    <div class="bg-white rounded-[5rem] border border-blue-50 p-16 hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-700 hover:-translate-y-4 group relative overflow-hidden flex flex-col"
                        data-aos="zoom-in" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                        <div class="absolute top-10 right-10 flex flex-col items-end gap-2">
                            @if($badge)
                                <span
                                    class="bg-blue-600 text-white text-[9px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-lg italic">{{ $badge }}</span>
                            @endif
                            @if($ageRange)
                                <span
                                    class="bg-slate-100 text-slate-400 text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-sm italic">{{ $ageRange }}</span>
                            @endif
                        </div>

                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->display_title }}"
                                class="w-32 h-32 rounded-[3.5rem] object-cover mb-12 shadow group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div
                                class="w-32 h-32 bg-blue-50 text-primary rounded-[3.5rem] flex items-center justify-center mb-12 group-hover:bg-primary group-hover:text-white transition-all duration-700 shadow-inner group-hover:rotate-12">
                                <i class="{{ $program->display_icon }} text-5xl"></i>
                            </div>
                        @endif

                        <h3 class="text-4xl font-black text-slate-900 mb-8 italic uppercase tracking-tighter">
                            {{ $program->display_title }}</h3>
                        <p class="text-slate-500 font-medium leading-[2] mb-12 text-sm opacity-80 italic text-justify">{{ $desc }}
                        </p>

                        @if($program->features->isNotEmpty())
                            <div class="space-y-5 mb-16 border-t border-slate-50 pt-12 flex-grow">
                                @foreach($program->features->take(4) as $feature)
                                    <div
                                        class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                                        <i class="{{ $feature->icon ?? 'fas fa-check-circle' }} text-primary"></i>
                                        {{ $feature->feature_text }}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if($highlight)
                            <div class="mb-12 p-8 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                                <p
                                    class="text-primary text-[10px] font-black uppercase tracking-[0.2em] italic leading-none mb-4 flex items-center gap-3">
                                    <span class="w-8 h-[2px] bg-primary rounded-full"></span> Value Utama
                                </p>
                                <p class="text-lg font-black text-slate-900 italic tracking-tighter uppercase leading-tight">
                                    {{ $highlight->title }}</p>
                            </div>
                        @endif

                        <a href="{{ $btnLink }}" target="_blank"
                            class="group/button block text-center bg-slate-900 text-white px-10 py-7 rounded-[3rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-primary hover:scale-[1.02] transition-all duration-500 shadow-xl shadow-blue-900/10 mt-auto flex items-center justify-center gap-4">
                            {{ $btnText }} <i class="fab fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                @endif

            @empty
                <div class="col-span-3 text-center py-20 text-slate-400">
                    <div class="text-5xl mb-4">📚</div>
                    <p class="font-medium">Program belum tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </section>

    <!-- Konsultasi Section -->
    @php
        $whatsappNumber = \App\Models\Setting::get('contact_whatsapp') 
            ?? \App\Models\Setting::get('contact_cta_whatsapp_number') 
            ?? '6283157112597';
        $whatsappClean = preg_replace('/\D/', '', $whatsappNumber);
    @endphp
    <section class="py-40 bg-white px-6 overflow-hidden">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <!-- Consultation -->
            <div class="w-full p-16 md:p-24 bg-slate-900 border border-white/10 rounded-[5rem] relative overflow-hidden group shadow-[0_50px_100px_rgba(0,0,0,0.3)] text-center flex flex-col items-center">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/20 blur-[120px] rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-secondary/10 blur-[100px] rounded-full"></div>
                
                <span class="text-secondary font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic">Ready to Start?</span>
                
                <h4 class="text-5xl md:text-6xl font-black text-white tracking-tighter italic uppercase mb-12 leading-none">
                    Konsultasi <span class="text-secondary italic">Gratis</span> <br />via WhatsApp
                </h4>
                
                <p class="text-xl text-slate-400 font-medium leading-[2] mb-12 italic opacity-90 max-w-2xl">
                    Masih bingung menentukan program yang paling pas untuk si kecil? Bicarakan kebutuhan Anda langsung
                    dengan tim pendidikan kami.
                    <span class="text-white font-black">Fast response & Ramah.</span>
                </p>
                
                <a href="https://wa.me/{{ $whatsappClean }}" target="_blank"
                    class="bg-secondary text-brand-dark px-14 py-8 rounded-[4rem] font-black text-xl uppercase tracking-widest hover:bg-white hover:scale-105 transition-all inline-flex items-center gap-6 group shadow-2xl shadow-yellow-400/20 relative z-10">
                    Klik Chat Sekarang <i class="fab fa-whatsapp text-3xl group-hover:rotate-12 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

@endsection