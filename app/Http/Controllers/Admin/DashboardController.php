<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

/**
 * DashboardController: halaman utama dashboard admin.
 * Menampilkan ringkasan statistik penting untuk admin.
 */
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => Registration::count(),
            'need_contact'    => Registration::where('status', 'need_contact')->count(),
            'contacted'       => Registration::where('status', 'contacted')->count(),
            'rejected'        => Registration::where('status', 'rejected')->count(),
        ];

        // 5 pendaftar terbaru
        $latestRegistrations = Registration::with('program')
            ->latestFirst()
            ->limit(5)
            ->get();

        $adminName = Auth::user()->name;

        return view('admin.dashboard.index', compact('stats', 'latestRegistrations', 'adminName'));
    }
}
