<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Program;
use Illuminate\Http\Request;

/**
 * RegistrationController (Legacy — semua route diarahkan ke RegistrationAdminController).
 * Route lama: admin.register.registrations.*
 * Route baru: admin.registrations.*
 *
 * Seluruh method di sini melakukan redirect permanen ke route baru
 * agar tidak terjadi "View not found" error jika route lama diakses langsung.
 */
class RegistrationController extends Controller
{
    /**
     * Redirect route lama index ke route baru.
     * GET /admin/register/registrations → /admin/registrations
     */
    public function index(Request $request)
    {
        // Teruskan semua query string (search, status, dll) ke route baru
        return redirect()->route('admin.registrations.index', $request->query());
    }

    /**
     * Redirect route lama show ke route baru.
     */
    public function show(Registration $registration)
    {
        return redirect()->route('admin.registrations.show', $registration);
    }

    /**
     * Redirect route lama edit ke route baru show (RegistrationAdminController tidak punya edit form terpisah).
     */
    public function edit(Registration $registration)
    {
        return redirect()->route('admin.registrations.show', $registration);
    }

    /**
     * Update data (tidak digunakan di route baru, redirect ke show).
     */
    public function update(Request $request, Registration $registration)
    {
        return redirect()->route('admin.registrations.show', $registration);
    }

    /**
     * Hapus data, kemudian redirect ke index baru.
     */
    public function destroy(Registration $registration)
    {
        $name = $registration->student_name;
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', "🗑️ Data pendaftar \"{$name}\" berhasil dihapus!");
    }

    /**
     * Update status — redirect ke halaman sebelumnya (tetap kompatibel).
     */
    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Registration::STATUSES)),
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'contacted' && !$registration->contacted_at) {
            $data['contacted_at'] = now();
        }

        $registration->update($data);

        return redirect()->back()
            ->with('success', "✅ Status diubah ke: " . Registration::STATUSES[$request->status]);
    }
}
