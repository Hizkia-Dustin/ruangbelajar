<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRegistrationStatusRequest;
use App\Http\Requests\Admin\RegistrationNoteRequest;
use App\Models\Registration;
use App\Models\Program;
use Illuminate\Http\Request;

/**
 * RegistrationAdminController
 * Mengelola data pendaftar: list, detail, update status, catatan, bulk action, export.
 */
class RegistrationAdminController extends Controller
{
    // =================== INDEX (LIST + FILTER + SEARCH) ===================

    public function index(Request $request)
    {
        $query = Registration::with('program')->latestFirst();

        // Search: nama siswa / orang tua / WA / email
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter tanggal (dari - sampai)
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $registrations = $query->paginate(20)->withQueryString();
        $programs      = Program::orderBy('urutan')->get();
        $statuses      = Registration::STATUSES;

        // Statistik kartu header
        $stats = [
            'total'        => Registration::count(),
            'need_contact' => Registration::where('status', 'need_contact')->count(),
            'contacted'    => Registration::where('status', 'contacted')->count(),
            'rejected'     => Registration::where('status', 'rejected')->count(),
        ];

        return view('admin.registrations.index', compact(
            'registrations', 'programs', 'statuses', 'stats'
        ));
    }

    // =================== SHOW (DETAIL) ===================

    public function show(Registration $registration)
    {
        $registration->load('program');
        $statuses = Registration::STATUSES;

        return view('admin.registrations.show', compact('registration', 'statuses'));
    }

    // =================== UPDATE STATUS ===================

    public function updateStatus(UpdateRegistrationStatusRequest $request, Registration $registration)
    {
        $data = ['status' => $request->status];

        if ($request->status === 'contacted' && !$registration->contacted_at) {
            $data['contacted_at'] = now();
        }

        $registration->update($data);

        return redirect()->back()
            ->with('success', '✅ Status diubah ke: ' . Registration::STATUSES[$request->status]);
    }

    // =================== UPDATE NOTE ===================

    public function updateNote(RegistrationNoteRequest $request, Registration $registration)
    {
        $registration->update(['admin_notes' => $request->admin_notes]);

        return redirect()->back()
            ->with('success', '✅ Catatan admin berhasil disimpan!');
    }

    // =================== DELETE ===================

    public function destroy(Registration $registration)
    {
        $name = $registration->student_name;
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', "🗑️ Data pendaftar \"{$name}\" berhasil dihapus!");
    }

    // =================== BULK ACTION ===================

    public function bulk(Request $request)
    {
        $request->validate([
            'ids'    => 'required|array',
            'ids.*'  => 'exists:registrations,id',
            'action' => 'required|in:delete,need_contact,contacted,rejected',
        ]);

        $ids = $request->ids;

        if ($request->action === 'delete') {
            Registration::whereIn('id', $ids)->delete();
            return redirect()->back()
                ->with('success', "🗑️ " . count($ids) . " data berhasil dihapus!");
        }

        // Bulk status update
        $statusData = ['status' => $request->action];
        if ($request->action === 'contacted') {
            // Hanya set contacted_at jika belum di-set
            Registration::whereIn('id', $ids)
                ->whereNull('contacted_at')
                ->update(['contacted_at' => now()]);
        }
        Registration::whereIn('id', $ids)->update($statusData);

        $label = Registration::STATUSES[$request->action] ?? $request->action;
        return redirect()->back()
            ->with('success', "✅ " . count($ids) . " data diubah ke status: {$label}!");
    }

    // =================== EXPORT CSV ===================

    public function exportCsv(Request $request)
    {
        $query = Registration::with('program')->latestFirst();

        if ($request->filled('status'))     $query->byStatus($request->status);
        if ($request->filled('program_id')) $query->where('program_id', $request->program_id);
        if ($request->filled('search'))     $query->search($request->search);
        if ($request->filled('date_from'))  $query->whereDate('created_at', '>=', $request->date_from);
        if ($request->filled('date_to'))    $query->whereDate('created_at', '<=', $request->date_to);

        $rows = $query->get();

        $filename = 'pendaftar_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $handle = fopen('php://output', 'w');
            // BOM untuk Excel UTF-8
            fputs($handle, "\xEF\xBB\xBF");
            // Header row
            fputcsv($handle, [
                'No', 'Nama Siswa', 'Usia', 'Kelas', 'Sekolah',
                'Nama Wali', 'WhatsApp', 'Email',
                'Program', 'Status', 'Sumber',
                'Catatan Pendaftar', 'Catatan Admin',
                'Waktu Daftar', 'Waktu Dihubungi',
            ]);
            foreach ($rows as $i => $r) {
                fputcsv($handle, [
                    $i + 1,
                    $r->student_name,
                    $r->age,
                    $r->class_name,
                    $r->school,
                    $r->parent_name,
                    $r->whatsapp,
                    $r->email,
                    $r->display_program,
                    Registration::STATUSES[$r->status] ?? $r->status,
                    $r->source,
                    $r->notes,
                    $r->admin_notes,
                    $r->created_at?->format('d/m/Y H:i'),
                    $r->contacted_at?->format('d/m/Y H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
