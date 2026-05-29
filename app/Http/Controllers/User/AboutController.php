<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use App\Models\AboutProblemSolutionSetting;
use App\Models\AboutProblemSolutionItem;
use App\Models\AboutStatistic;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        // Data dinamis dari about_settings (singleton)
        $aboutSetting = AboutSetting::getInstance();

        // Problem vs Solution dinamis
        $probSolSetting = AboutProblemSolutionSetting::getInstance();
        $probSolItems   = AboutProblemSolutionItem::active()->get();

        // Statistik dinamis Tentang Kami
        $aboutStatistics = AboutStatistic::active()->get();

        $testimonials = Testimonial::active()
            ->where('tampil_di_tentang', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.about', compact(
            'aboutSetting', 'probSolSetting', 'probSolItems', 'aboutStatistics', 'testimonials'
        ));
    }
}
