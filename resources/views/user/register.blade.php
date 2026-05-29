@extends('user.layout')

@section('title', 'Pendaftaran Peserta')

@section('content')

<!-- Global Container (Light/Clean Style) -->
<section class="min-h-screen relative flex items-center justify-center bg-brand-light overflow-hidden py-32 px-6">
    <!-- Animated background layers (Soft) -->
    <div class="absolute top-0 left-0 w-full h-[150%] bg-blue-500/5 blur-[150px] rounded-full -translate-y-1/2"></div>
    
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-24 items-center relative z-10">
        
        <!-- Left Side: Value & Social Proof -->
        <div data-aos="fade-right">
             <div class="inline-flex items-center gap-4 bg-white border border-blue-100 px-6 py-3 rounded-full mb-12 shadow-sm">
                <span class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white"><i class="fas fa-check text-[10px]"></i></span>
                <span class="text-brand-dark font-black text-[10px] tracking-[0.3em] uppercase italic">{{ optional($hero)->badge_text ?? 'Pendaftaran Terbuka' }}</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-brand-dark mb-12 tracking-tighter italic uppercase leading-none break-words">
                {{ optional($hero)->title_line_1 ?? 'Mulai Perjalanan Belajar' }}
                @if(optional($hero)->title_line_2)
                    <br />{{ optional($hero)->title_line_2 }}
                @endif
                @if(optional($hero)->title_highlight)
                    <br />
                    <span class="text-primary italic underline decoration-blue-100 decoration-[6px] md:decoration-[10px]">{{ optional($hero)->title_highlight }}</span>
                @endif
            </h1>
            
            <p class="text-xl md:text-2xl text-slate-500 font-medium leading-[2] mb-16 max-w-lg italic opacity-80">
                {{ optional($hero)->description ?? 'Daftarkan putra-putri Anda sekarang dan rasakan pengalaman belajar yang berbeda. Kelas kecil, metode playful, dan pendampingan penuh.' }}
            </p>
            
            <!-- Value Points -->
            <div class="space-y-10 mb-16">
                <!-- Benefit 1 -->
                <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">{{ optional($hero)->benefit_1_title ?? 'Kelas Super Kecil' }}</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">{{ optional($hero)->benefit_1_description ?? 'Maksimal 5 anak per sesi untuk kenyamanan belajar.' }}</p>
                    </div>
                </div>
                
                <!-- Benefit 2 -->
                <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">{{ optional($hero)->benefit_2_title ?? 'Metode Playful' }}</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">{{ optional($hero)->benefit_2_description ?? 'Belajar asik tanpa tekanan melalui pendekatan personal.' }}</p>
                    </div>
                </div>

                <!-- Benefit 3 -->
                <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">{{ optional($hero)->benefit_3_title ?? 'Konsultasi Gratis' }}</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">{{ optional($hero)->benefit_3_description ?? 'Bantu pilihkan program terbaik untuk putra-putri Anda.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Social Proof -->
            <div class="p-10 bg-white border border-blue-100 rounded-[3.5rem] shadow-2xl shadow-blue-900/5 inline-flex items-center gap-8">
                 <div class="flex -space-x-4 flex-shrink-0">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+1&background=2563EB&color=fff" alt="User">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+2&background=FACC15&color=000" alt="User">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+3&background=1E40AF&color=fff" alt="User">
                 </div>
                 <div>
                    <p class="text-2xl font-black text-brand-dark italic leading-none">{{ optional($hero)->counter_text ?? '100+ Anak' }}</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1 italic">{{ optional($hero)->counter_description ?? 'Telah Bergabung Bersama Kami' }}</p>
                 </div>
            </div>
        </div>

        <!-- Right Side: Focus Form -->
        <div class="bg-white p-12 md:p-20 rounded-[5rem] shadow-[0_50px_120px_rgba(30,58,138,0.1)] border border-blue-50 relative overflow-hidden group" data-aos="fade-left">
            <h2 class="text-5xl font-black text-brand-dark mb-16 tracking-tighter italic uppercase">
                {{ optional($formSetting)->form_title ?? 'Isi Data' }} <span class="text-primary italic">{{ optional($formSetting)->form_highlight ?? 'Pendaftaran.' }}</span>
            </h2>

            {{-- Flash Success Alert --}}
            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-6 rounded-3xl mb-8 text-sm font-semibold flex items-center gap-3">
                <span class="text-lg">✅</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            {{-- Validation Error Alert --}}
            @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-6 rounded-3xl mb-8 text-sm font-semibold">
                <div class="flex items-center gap-2 mb-2 text-rose-900">
                    <span class="text-lg">⚠️</span>
                    <span>Mohon koreksi kesalahan berikut:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-xs">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('register.store') }}" method="POST" class="space-y-10 relative z-10">
                @csrf

                <!-- Nama Lengkap Anak -->
                <div>
                    <label for="student_name" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_child_name ?? 'Nama Lengkap Anak' }} *</label>
                    <input type="text" name="student_name" id="student_name" value="{{ old('student_name') }}" placeholder="{{ optional($formSetting)->placeholder_child_name ?? 'Masukkan nama putra/putri Anda' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic" required>
                </div>

                <!-- Nama Orang Tua / Wali -->
                <div>
                    <label for="parent_name" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_parent_name ?? 'Nama Orang Tua / Wali' }} *</label>
                    <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name') }}" placeholder="{{ optional($formSetting)->placeholder_parent_name ?? 'Masukkan nama Ibu / Ayah / Wali' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Umur -->
                    <div>
                        <label for="age" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_age ?? 'Umur Anak' }}</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}" placeholder="{{ optional($formSetting)->placeholder_age ?? 'Contoh: 5' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                    </div>
                    <!-- Kelas -->
                    <div>
                        <label for="class_name" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_class ?? 'Kelas' }}</label>
                        <input type="text" name="class_name" id="class_name" value="{{ old('class_name') }}" placeholder="{{ optional($formSetting)->placeholder_class ?? 'Contoh: TK-B atau 1 SD' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                    </div>
                </div>

                <!-- Program -->
                <div>
                    <label for="program_id" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_program ?? 'Pilih Program Belajar' }}</label>
                    <div class="relative">
                        <select name="program_id" id="program_id" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white appearance-none transition-all duration-300 italic">
                            <option value="">{{ optional($formSetting)->placeholder_program ?? '-- Pilih Program --' }}</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->display_title }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-primary">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- No HP (WhatsApp) -->
                <div>
                    <label for="whatsapp" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_whatsapp ?? 'Nomor WhatsApp Aktif' }} *</label>
                    <input type="tel" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="{{ optional($formSetting)->placeholder_whatsapp ?? 'Contoh: 0812xxxxxx' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic" required>
                </div>

                <!-- Notes / Catatan -->
                <div>
                    <label for="notes" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">{{ optional($formSetting)->label_note ?? 'Catatan / Keterangan Tambahan' }}</label>
                    <textarea name="notes" id="notes" rows="4" placeholder="{{ optional($formSetting)->placeholder_note ?? 'Tuliskan catatan tambahan jika ada...' }}" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic resize-none">{{ old('notes') }}</textarea>
                </div>

                <!-- Trust Badges -->
                <div class="flex flex-wrap gap-8 py-4 opacity-60">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-halved text-primary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest italic leading-none">{{ optional($formSetting)->trust_text_1 ?? 'Data Aman Terlindungi' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-bolt text-secondary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest italic leading-none">{{ optional($formSetting)->trust_text_2 ?? 'Respon Cepat Kilat' }}</span>
                    </div>
                </div>

                <!-- WhatsApp Notice / Privacy Notice (if filled in admin) -->
                @if($formSetting && ($formSetting->whatsapp_notice || $formSetting->privacy_notice))
                <div class="space-y-4 py-4 opacity-75">
                    @if($formSetting->whatsapp_notice)
                    <div class="flex items-start gap-3 text-xs font-bold text-slate-500 italic">
                        <i class="fab fa-whatsapp text-green-500 text-lg mt-0.5"></i>
                        <span>{{ $formSetting->whatsapp_notice }}</span>
                    </div>
                    @endif
                    @if($formSetting->privacy_notice)
                    <div class="flex items-start gap-3 text-xs font-bold text-slate-500 italic">
                        <i class="fas fa-shield-halved text-primary text-lg mt-0.5"></i>
                        <span>{{ $formSetting->privacy_notice }}</span>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-white py-10 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-blue-900/20 hover:bg-brand-dark hover:scale-105 transition-all active:scale-[0.98] mt-12 group flex items-center justify-center gap-6 italic uppercase tracking-tighter">
                    {{ optional($formSetting)->button_text ?? 'Daftar Sekarang' }} <i class="fas fa-arrow-right text-xl transition-transform group-hover:translate-x-3"></i>
                </button>
            </form>
            
            <!-- Bottom Accent -->
            <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-primary/5 rounded-full blur-3xl"></div>
        </div>
    </div>
</section>

@endsection
