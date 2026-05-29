<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\Keunggulan;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\HomeSolutionSetting;
use App\Models\HomeSolutionPoint;

class HomeController extends Controller
{
    public function index()
    {
        // Data dinamis dari home_settings (singleton)
        $homeSetting  = HomeSetting::getInstance();

        // Hanya keunggulan aktif, diurutkan by sort_order
        $keunggulans  = Keunggulan::active()->get();

        // Program & testimoni tetap dari tabel masing-masing
        $programs     = Program::active()->get();
        $testimonials = Testimonial::active()
            ->where('tampil_di_beranda', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        // Home Program Cards (CRUD 3 cards di kanan)
        $homeProgramCards = \App\Models\HomeProgramCard::active()->get();

        // Solution section
        $solutionSetting = HomeSolutionSetting::getInstance();
        $solutionPoints  = HomeSolutionPoint::active()->get();

        return view('user.home', compact('homeSetting', 'keunggulans', 'programs', 'testimonials', 'solutionSetting', 'solutionPoints', 'homeProgramCards'));
    }
}
