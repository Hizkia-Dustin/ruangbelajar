<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Program;
use App\Models\RegisterHeroSetting;
use App\Models\RegisterFormSetting;
use Illuminate\Http\Request;

/**
 * RegisterController (User-side): Menampilkan halaman pendaftaran dan menyimpan data form.
 * Berbeda dari AdminRegistrationController yang mengelola data di backend admin.
 */
class RegisterController extends Controller
{
    /**
     * Tampilkan halaman pendaftaran (GET /register).
     */
    public function index()
    {
        // Konten dinamis dari database
        $hero        = RegisterHeroSetting::with(['benefits' => fn($q) => $q->active()])->first();
        $formSetting = RegisterFormSetting::first();
        $programs    = Program::active()->get(); // Dropdown program dari tabel programs

        return view('user.register', compact('hero', 'formSetting', 'programs'));
    }

    /**
     * Simpan data pendaftaran (POST /register).
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'age'          => 'nullable|integer|min:1|max:99',
            'class_name'   => 'nullable|string|max:100',
            'parent_name'  => 'required|string|max:255',
            'whatsapp'     => 'required|string|max:20',
            'program_id'   => 'nullable|exists:programs,id',
            'notes'        => 'nullable|string|max:1000',
        ], [
            'student_name.required' => 'Nama siswa wajib diisi.',
            'parent_name.required'  => 'Nama orang tua/wali wajib diisi.',
            'whatsapp.required'     => 'Nomor WhatsApp wajib diisi.',
            'program_id.exists'     => 'Program yang dipilih tidak valid.',
        ]);

        $programName = null;
        if ($request->program_id) {
            $programName = Program::find($request->program_id)?->display_title;
        }

        Registration::create([
            'student_name'     => $request->student_name,
            'age'              => $request->age,
            'class_name'       => $request->class_name,
            'parent_name'      => $request->parent_name,
            'whatsapp'         => $request->whatsapp,
            'program_id'       => $request->program_id ?: null,
            'program_name'     => $programName,
            'selected_program' => $programName,
            'notes'            => $request->notes,
            'status'           => 'need_contact',
            'source'           => 'web',
        ]);

        // Ambil pesan sukses dari database (atau fallback default)
        $successMessage = optional(RegisterFormSetting::first())->success_message
            ?? 'Terima kasih! Pendaftaran Anda berhasil dikirim. Tim kami akan menghubungi Anda segera.';

        return redirect()->route('register')
            ->with('success', $successMessage);
    }
}
