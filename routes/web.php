<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ProgramController as UserProgramController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\SitemapController;

// ---- Admin Controllers ----
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\Admin\ProgramAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\AboutApproachController;
use App\Http\Controllers\Admin\ProgramPageSettingController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProgramFeatureController;
use App\Http\Controllers\Admin\ProgramHighlightController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\ContactCtaFeatureController;
use App\Http\Controllers\Admin\ContactFaqController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\KeunggulanController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\RegisterHeroSettingController;
use App\Http\Controllers\Admin\RegisterBenefitController;
use App\Http\Controllers\Admin\RegisterFormSettingController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\RegistrationAdminController;
use App\Http\Controllers\Admin\KontakAdminController;
use App\Http\Controllers\Admin\FooterAdminController;
use App\Http\Controllers\Admin\SosmedAdminController;



// ============================
// USER / PUBLIC ROUTES
// ============================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/program', [UserProgramController::class, 'index'])->name('program');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Sitemap & Robots (public)
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// ============================
// ADMIN AUTH ROUTES (Tanpa middleware — halaman login harus publik)
// ============================
Route::prefix('admin')->name('admin.')->group(function () {

    // GET  /admin/login  → tampil form login
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');

    // POST /admin/login  → proses login
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');

    // POST /admin/logout → proses logout
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
});

// ============================
// ADMIN ROUTES (Diproteksi middleware 'admin')
// ============================
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // ---- DASHBOARD ----
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Redirect /admin → /admin/dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'));

    // ---- BERANDA (CMS baru) ----
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');
    Route::put('/beranda/hero', [BerandaController::class, 'updateHero'])->name('beranda.hero.update');
    Route::post('/beranda/website-logo', [BerandaController::class, 'updateWebsiteLogo'])->name('beranda.website-logo.update');
    Route::post('/beranda/whatsapp-floating', [BerandaController::class, 'updateWhatsappFloating'])->name('beranda.whatsapp-floating.update');
    Route::post('/beranda/keunggulan', [BerandaController::class, 'storeKeunggulan'])->name('beranda.keunggulan.store');
    Route::get('/beranda/keunggulan/{keunggulan}/edit', [BerandaController::class, 'editKeunggulan'])->name('beranda.keunggulan.edit');
    Route::put('/beranda/keunggulan/{keunggulan}', [BerandaController::class, 'updateKeunggulan'])->name('beranda.keunggulan.update');
    Route::delete('/beranda/keunggulan/{keunggulan}', [BerandaController::class, 'destroyKeunggulan'])->name('beranda.keunggulan.destroy');
    Route::patch('/beranda/keunggulan/{keunggulan}/toggle', [BerandaController::class, 'toggleKeunggulan'])->name('beranda.keunggulan.toggle');

    // ---- BERANDA PROGRAM CARDS CRUD ----
    Route::post('/beranda/program-card', [BerandaController::class, 'storeProgramCard'])->name('beranda.program-card.store');
    Route::put('/beranda/program-card/{card}', [BerandaController::class, 'updateProgramCard'])->name('beranda.program-card.update');
    Route::delete('/beranda/program-card/{card}', [BerandaController::class, 'destroyProgramCard'])->name('beranda.program-card.destroy');
    Route::patch('/beranda/program-card/{card}/toggle', [BerandaController::class, 'toggleProgramCard'])->name('beranda.program-card.toggle');

    // ---- BERANDA SOLUTION SECTION ----
    Route::put('/beranda/solution', [BerandaController::class, 'updateSolutionSetting'])->name('beranda.solution.update');
    Route::post('/beranda/solution-point', [BerandaController::class, 'storeSolutionPoint'])->name('beranda.solution-point.store');
    Route::put('/beranda/solution-point/{point}', [BerandaController::class, 'updateSolutionPoint'])->name('beranda.solution-point.update');
    Route::delete('/beranda/solution-point/{point}', [BerandaController::class, 'destroySolutionPoint'])->name('beranda.solution-point.destroy');
    Route::patch('/beranda/solution-point/{point}/toggle', [BerandaController::class, 'toggleSolutionPoint'])->name('beranda.solution-point.toggle');

    // ---- BERANDA LEGACY (redirect ke beranda CMS baru) ----
    Route::get('/settings', fn() => redirect()->route('admin.beranda.index'))->name('settings.index');
    Route::put('/settings', fn() => redirect()->route('admin.beranda.index'))->name('settings.update');
    Route::get('/keunggulan', fn() => redirect()->route('admin.beranda.index'))->name('keunggulan.index');
    Route::get('/keunggulan/create', fn() => redirect()->route('admin.beranda.index'))->name('keunggulan.create');
    Route::get('/keunggulan/{keunggulan}/edit', fn() => redirect()->route('admin.beranda.index'))->name('keunggulan.edit');



    // ---- TENTANG KAMI (CMS baru) ----
    Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');
    Route::put('/tentang/setting', [TentangController::class, 'updateSetting'])->name('tentang.setting.update');
    Route::put('/tentang/story', [TentangController::class, 'updateStory'])->name('tentang.story.update');
    Route::put('/tentang/problem-solution', [TentangController::class, 'updateProblemSolutionSetting'])->name('tentang.problem-solution.update');
    Route::post('/tentang/problem-solution-item', [TentangController::class, 'storeProblemSolutionItem'])->name('tentang.problem-solution-item.store');
    Route::put('/tentang/problem-solution-item/{item}', [TentangController::class, 'updateProblemSolutionItem'])->name('tentang.problem-solution-item.update');
    Route::delete('/tentang/problem-solution-item/{item}', [TentangController::class, 'destroyProblemSolutionItem'])->name('tentang.problem-solution-item.destroy');
    Route::patch('/tentang/problem-solution-item/{item}/toggle', [TentangController::class, 'toggleProblemSolutionItem'])->name('tentang.problem-solution-item.toggle');
    Route::post('/tentang/statistic', [TentangController::class, 'storeStatistic'])->name('tentang.statistic.store');
    Route::put('/tentang/statistic/{statistic}', [TentangController::class, 'updateStatistic'])->name('tentang.statistic.update');
    Route::delete('/tentang/statistic/{statistic}', [TentangController::class, 'destroyStatistic'])->name('tentang.statistic.destroy');
    Route::patch('/tentang/statistic/{statistic}/toggle', [TentangController::class, 'toggleStatistic'])->name('tentang.statistic.toggle');

    // ---- TENTANG KAMI LEGACY (redirect ke tentang CMS baru) ----
    Route::get('/about/settings', fn() => redirect()->route('admin.tentang.index'))->name('about.settings.index');
    Route::put('/about/settings', fn() => redirect()->route('admin.tentang.index'))->name('about.settings.update');

    // ---- PROGRAM (CMS baru) ----
    Route::get('/programs', [ProgramAdminController::class, 'index'])->name('programs.index');
    Route::get('/programs/create', [ProgramAdminController::class, 'create'])->name('programs.create');
    Route::post('/programs', [ProgramAdminController::class, 'store'])->name('programs.store');
    Route::get('/programs/{program}/edit', [ProgramAdminController::class, 'edit'])->name('programs.edit');
    Route::put('/programs/{program}', [ProgramAdminController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}', [ProgramAdminController::class, 'destroy'])->name('programs.destroy');
    Route::patch('/programs/{program}/toggle', [ProgramAdminController::class, 'toggle'])->name('programs.toggle');
    Route::patch('/programs/{program}/toggle-featured', [ProgramAdminController::class, 'toggleFeatured'])->name('programs.toggle-featured');
    // Features
    Route::post('/programs/{program}/features', [ProgramAdminController::class, 'storeFeature'])->name('programs.features.store');
    Route::put('/programs/{program}/features/{feature}', [ProgramAdminController::class, 'updateFeature'])->name('programs.features.update');
    Route::delete('/programs/{program}/features/{feature}', [ProgramAdminController::class, 'destroyFeature'])->name('programs.features.destroy');
    // Highlights
    Route::post('/programs/{program}/highlights', [ProgramAdminController::class, 'storeHighlight'])->name('programs.highlights.store');
    Route::put('/programs/{program}/highlights/{highlight}', [ProgramAdminController::class, 'updateHighlight'])->name('programs.highlights.update');
    Route::delete('/programs/{program}/highlights/{highlight}', [ProgramAdminController::class, 'destroyHighlight'])->name('programs.highlights.destroy');

    // ---- PROGRAM LEGACY (redirect ke programs CMS baru) ----
    Route::get('/program/settings', fn() => redirect()->route('admin.programs.index'))->name('program.settings.index');
    Route::put('/program/settings', fn() => redirect()->route('admin.programs.index'))->name('program.settings.update');
    Route::resource('program', ProgramController::class)->except(['show']);
    Route::get('/program/{program}/features', fn($program) => redirect()->route('admin.programs.edit', $program))->name('program.features.index');
    Route::get('/program/{program}/features/create', fn($program) => redirect()->route('admin.programs.edit', $program))->name('program.features.create');
    Route::get('/program/{program}/features/{feature}/edit', fn($program, $feature) => redirect()->route('admin.programs.edit', $program))->name('program.features.edit');
    Route::get('/program/{program}/highlights', fn($program) => redirect()->route('admin.programs.edit', $program))->name('program.highlights.index');
    Route::get('/program/{program}/highlights/create', fn($program) => redirect()->route('admin.programs.edit', $program))->name('program.highlights.create');
    Route::get('/program/{program}/highlights/{highlight}/edit', fn($program, $highlight) => redirect()->route('admin.programs.edit', $program))->name('program.highlights.edit');

    // ---- KONTAK LEGACY (redirect ke kontak / sosmed CMS baru) ----
    Route::get('/contact/settings', fn() => redirect()->route('admin.kontak.index'))->name('contact.settings.index');
    Route::put('/contact/settings', fn() => redirect()->route('admin.kontak.index'))->name('contact.settings.update');
    Route::get('/contact/cta-features', fn() => redirect()->route('admin.kontak.index'))->name('contact.cta-features.index');
    Route::get('/contact/cta-features/create', fn() => redirect()->route('admin.kontak.index'))->name('contact.cta-features.create');
    Route::get('/contact/cta-features/{cta_feature}/edit', fn() => redirect()->route('admin.kontak.index'))->name('contact.cta-features.edit');
    Route::get('/contact/faq', fn() => redirect()->route('admin.kontak.index'))->name('contact.faq.index');
    Route::get('/contact/faq/create', fn() => redirect()->route('admin.kontak.index'))->name('contact.faq.create');
    Route::get('/contact/faq/{faq}/edit', fn() => redirect()->route('admin.kontak.index'))->name('contact.faq.edit');
    Route::get('/contact/social-media', fn() => redirect()->route('admin.sosmed.index'))->name('contact.social-media.index');
    Route::get('/contact/social-media/create', fn() => redirect()->route('admin.sosmed.index'))->name('contact.social-media.create');
    Route::get('/contact/social-media/{social_media}/edit', fn() => redirect()->route('admin.sosmed.index'))->name('contact.social-media.edit');

    // ---- KONTAK CMS (baru) ----
    Route::get('/kontak', [KontakAdminController::class, 'index'])->name('kontak.index');
    Route::post('/kontak/info', [KontakAdminController::class, 'updateInfo'])->name('kontak.update-info');
    Route::post('/kontak/faq', [KontakAdminController::class, 'storeFaq'])->name('kontak.faq.store');
    Route::put('/kontak/faq/{faq}', [KontakAdminController::class, 'updateFaq'])->name('kontak.faq.update');
    Route::delete('/kontak/faq/{faq}', [KontakAdminController::class, 'destroyFaq'])->name('kontak.faq.destroy');
    Route::patch('/kontak/faq/{faq}/toggle', [KontakAdminController::class, 'toggleFaq'])->name('kontak.faq.toggle');
    Route::post('/kontak/cta-feature', [KontakAdminController::class, 'storeCtaFeature'])->name('kontak.cta-feature.store');
    Route::put('/kontak/cta-feature/{feature}', [KontakAdminController::class, 'updateCtaFeature'])->name('kontak.cta-feature.update');
    Route::delete('/kontak/cta-feature/{feature}', [KontakAdminController::class, 'destroyCtaFeature'])->name('kontak.cta-feature.destroy');
    Route::patch('/kontak/cta-feature/{feature}/toggle', [KontakAdminController::class, 'toggleCtaFeature'])->name('kontak.cta-feature.toggle');

    // ---- FOOTER CMS (baru) ----
    Route::get('/footer', [FooterAdminController::class, 'index'])->name('footer.index');
    Route::post('/footer', [FooterAdminController::class, 'update'])->name('footer.update');

    // ---- SOSIAL MEDIA CMS (baru) ----
    Route::get('/sosmed', [SosmedAdminController::class, 'index'])->name('sosmed.index');
    Route::post('/sosmed', [SosmedAdminController::class, 'store'])->name('sosmed.store');
    Route::put('/sosmed/{sosmed}', [SosmedAdminController::class, 'update'])->name('sosmed.update');
    Route::delete('/sosmed/{sosmed}', [SosmedAdminController::class, 'destroy'])->name('sosmed.destroy');
    Route::patch('/sosmed/{sosmed}/toggle', [SosmedAdminController::class, 'toggle'])->name('sosmed.toggle');

    // ---- TESTIMONI ----
    Route::resource('testimonials', TestimonialAdminController::class)->except(['show']);
    Route::patch('/testimonials/{testimonial}/toggle-active', [TestimonialAdminController::class, 'toggleActive'])->name('testimonials.toggle-active');
    Route::patch('/testimonials/{testimonial}/toggle-featured', [TestimonialAdminController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');

    // ---- DATA PENDAFTAR (CMS baru) ----
    Route::get('/registrations', [RegistrationAdminController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/export-csv', [RegistrationAdminController::class, 'exportCsv'])->name('registrations.export-csv');
    Route::post('/registrations/bulk', [RegistrationAdminController::class, 'bulk'])->name('registrations.bulk');
    Route::get('/registrations/{registration}', [RegistrationAdminController::class, 'show'])->name('registrations.show');
    Route::patch('/registrations/{registration}/status', [RegistrationAdminController::class, 'updateStatus'])->name('registrations.update-status');
    Route::patch('/registrations/{registration}/note', [RegistrationAdminController::class, 'updateNote'])->name('registrations.update-note');
    Route::delete('/registrations/{registration}', [RegistrationAdminController::class, 'destroy'])->name('registrations.destroy');

    // ---- REGISTER / PENDAFTARAN LEGACY ----
    Route::get('/register/hero', [RegisterHeroSettingController::class, 'index'])->name('register.hero.index');
    Route::put('/register/hero', [RegisterHeroSettingController::class, 'update'])->name('register.hero.update');
    Route::get('/register/benefits', fn() => redirect()->route('admin.register.hero.index'))->name('register.benefits.index');
    Route::get('/register/benefits/create', fn() => redirect()->route('admin.register.hero.index'))->name('register.benefits.create');
    Route::get('/register/benefits/{benefit}/edit', fn() => redirect()->route('admin.register.hero.index'))->name('register.benefits.edit');
    Route::get('/register/form-setting', fn() => redirect()->route('admin.register.hero.index'))->name('register.form-setting.index');
    Route::put('/register/form-setting', fn() => redirect()->route('admin.register.hero.index'))->name('register.form-setting.update');
    Route::resource('register/registrations', RegistrationController::class)
        ->except(['create', 'store'])
        ->names('register.registrations');
    Route::patch('register/registrations/{registration}/status', [RegistrationController::class, 'updateStatus'])
        ->name('register.registrations.update-status');
});
