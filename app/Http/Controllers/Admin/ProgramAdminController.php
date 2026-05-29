<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramRequest;
use App\Http\Requests\Admin\ProgramFeatureRequest;
use App\Http\Requests\Admin\ProgramHighlightRequest;
use App\Models\Program;
use App\Models\ProgramFeature;
use App\Models\ProgramHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramAdminController extends Controller
{
    // =================== PROGRAM LIST ===================

    public function index()
    {
        $programs = Program::withCount(['features', 'highlights'])
            ->orderByRaw('COALESCE(sort_order, urutan, 0) ASC')
            ->get();

        return view('admin.program.index', compact('programs'));
    }

    // =================== CREATE PROGRAM ===================

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(ProgramRequest $request)
    {
        $data = $this->prepareData($request);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('images/programs', 'public');
            $data['image']     = $data['thumbnail'];
        }

        $data['status']      = $request->input('status', 'active');
        $data['nama_program'] = $request->title;
        $data['urutan']       = $request->input('sort_order', 0);

        Program::create($data);

        return redirect()->route('admin.programs.index')
            ->with('success', '✅ Program berhasil ditambahkan!');
    }

    // =================== EDIT PROGRAM ===================

    public function edit(Program $program)
    {
        $program->load(['features', 'highlights']);
        return view('admin.program.edit', compact('program'));
    }

    public function update(ProgramRequest $request, Program $program)
    {
        $data = $this->prepareData($request);

        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama
            $oldImg = $program->thumbnail ?: $program->image;
            if ($oldImg && Storage::disk('public')->exists($oldImg)) {
                Storage::disk('public')->delete($oldImg);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('images/programs', 'public');
            $data['image']     = $data['thumbnail'];
        }

        $data['status']      = $request->input('status', 'active');
        $data['nama_program'] = $request->title;
        $data['urutan']       = $request->input('sort_order', $program->urutan);

        $program->update($data);

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '✅ Program berhasil diperbarui!');
    }

    // =================== DELETE PROGRAM ===================

    public function destroy(Program $program)
    {
        $img = $program->thumbnail ?: $program->image;
        if ($img && Storage::disk('public')->exists($img)) {
            Storage::disk('public')->delete($img);
        }
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', '🗑️ Program berhasil dihapus!');
    }

    // =================== TOGGLE STATUS ===================

    public function toggle(Program $program)
    {
        $program->update(['is_active' => !$program->is_active]);
        $status = $program->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "✅ Program \"{$program->display_title}\" berhasil {$status}!");
    }

    public function toggleFeatured(Program $program)
    {
        $program->update(['is_featured' => !$program->is_featured]);
        $status = $program->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';

        return redirect()->back()
            ->with('success', "⭐ Program \"{$program->display_title}\" berhasil {$status}!");
    }

    // =================== FEATURES CRUD ===================

    public function storeFeature(ProgramFeatureRequest $request, Program $program)
    {
        $maxOrder = $program->features()->max('sort_order') ?? 0;

        $program->features()->create([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->input('sort_order', $maxOrder + 1),
        ]);

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '✅ Fitur berhasil ditambahkan!');
    }

    public function updateFeature(ProgramFeatureRequest $request, Program $program, ProgramFeature $feature)
    {
        $feature->update([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->input('sort_order', $feature->sort_order),
        ]);

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '✅ Fitur berhasil diperbarui!');
    }

    public function destroyFeature(Program $program, ProgramFeature $feature)
    {
        $feature->delete();

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '🗑️ Fitur berhasil dihapus!');
    }

    // =================== HIGHLIGHTS CRUD ===================

    public function storeHighlight(ProgramHighlightRequest $request, Program $program)
    {
        $maxOrder = $program->highlights()->max('sort_order') ?? 0;

        $program->highlights()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $maxOrder + 1),
        ]);

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '✅ Highlight berhasil ditambahkan!');
    }

    public function updateHighlight(ProgramHighlightRequest $request, Program $program, ProgramHighlight $highlight)
    {
        $highlight->update([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $highlight->sort_order),
        ]);

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '✅ Highlight berhasil diperbarui!');
    }

    public function destroyHighlight(Program $program, ProgramHighlight $highlight)
    {
        $highlight->delete();

        return redirect()->route('admin.programs.edit', $program)
            ->with('success', '🗑️ Highlight berhasil dihapus!');
    }

    // =================== HELPERS ===================

    private function prepareData(ProgramRequest $request): array
    {
        $data = $request->only([
            'title', 'subtitle', 'badge_text', 'kategori',
            'age_range', 'short_description',
            'button_text', 'button_link',
            'background_theme', 'sort_order',
            'is_active', 'is_featured',
        ]) + [
            'is_active'   => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ];

        if ($request->has('description')) {
            $data['deskripsi'] = $request->description;
        }

        return $data;
    }
}
