<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutSettingRequest;
use App\Http\Requests\Admin\AboutStoryRequest;
use App\Http\Requests\Admin\AboutProblemSolutionSettingRequest;
use App\Http\Requests\Admin\AboutProblemSolutionItemRequest;
use App\Http\Requests\Admin\AboutStatisticRequest;
use App\Models\AboutSetting;
use App\Models\AboutProblemSolutionSetting;
use App\Models\AboutProblemSolutionItem;
use App\Models\AboutStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * TentangController: Mengelola halaman CMS Tentang Kami dari admin panel.
 */
class TentangController extends Controller
{
    // ==========================================
    // MAIN PAGE
    // ==========================================

    public function index()
    {
        $setting               = AboutSetting::getInstance();
        $probSolSetting        = AboutProblemSolutionSetting::getInstance();
        $probSolItems          = AboutProblemSolutionItem::orderBy('type')->orderBy('sort_order')->orderBy('id')->get();
        $statistics            = AboutStatistic::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.tentang.index', compact('setting', 'probSolSetting', 'probSolItems', 'statistics'));
    }

    // ==========================================
    // HERO + VISI + MISI
    // ==========================================

    public function updateSetting(AboutSettingRequest $request)
    {
        $setting = AboutSetting::getInstance();

        $data = $request->only([
            'badge_text', 'title', 'highlighted_title', 'description',
            'vision_title', 'vision_description',
            'mission_title', 'mission_description',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image && Storage::disk('public')->exists($setting->hero_image)) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')
                ->store('about', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.tentang.index')
            ->with('success', '✅ Konten Utama Tentang Kami berhasil diperbarui!');
    }

    // ==========================================
    // KISAH KAMI (STORY)
    // ==========================================

    public function updateStory(AboutStoryRequest $request)
    {
        $setting = AboutSetting::getInstance();

        $data = $request->only([
            'story_title_line_1', 'story_title_highlight',
            'story_description', 'story_quote', 'story_bottom_text',
        ]);

        if ($request->hasFile('story_image')) {
            if ($setting->story_image && Storage::disk('public')->exists($setting->story_image)) {
                Storage::disk('public')->delete($setting->story_image);
            }
            $data['story_image'] = $request->file('story_image')
                ->store('about', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.tentang.index', '#story')
            ->with('success', '✅ Kisah Kami berhasil diperbarui!');
    }

    // ==========================================
    // PROBLEM VS SOLUTION SETTING
    // ==========================================

    public function updateProblemSolutionSetting(AboutProblemSolutionSettingRequest $request)
    {
        $setting = AboutProblemSolutionSetting::getInstance();

        $data = $request->only([
            'small_label', 'main_title', 'main_title_highlight',
            'problem_title', 'solution_title',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $setting->update($data);

        return redirect()->route('admin.tentang.index', '#problem-solution')
            ->with('success', '✅ Setelan Judul Problem vs Solution berhasil diperbarui!');
    }

    // ==========================================
    // PROBLEM VS SOLUTION ITEMS CRUD
    // ==========================================

    public function storeProblemSolutionItem(AboutProblemSolutionItemRequest $request)
    {
        $maxOrder = AboutProblemSolutionItem::where('type', $request->type)->max('sort_order') ?? 0;

        AboutProblemSolutionItem::create([
            'type'       => $request->type,
            'text'       => $request->text,
            'sort_order' => $request->input('sort_order', $maxOrder + 1),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#problem-solution')
            ->with('success', '✅ Item baru berhasil ditambahkan!');
    }

    public function updateProblemSolutionItem(AboutProblemSolutionItemRequest $request, AboutProblemSolutionItem $item)
    {
        $item->update([
            'type'       => $request->type,
            'text'       => $request->text,
            'sort_order' => $request->input('sort_order', $item->sort_order),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#problem-solution')
            ->with('success', '✅ Item berhasil diperbarui!');
    }

    public function destroyProblemSolutionItem(AboutProblemSolutionItem $item)
    {
        $item->delete();

        return redirect()->route('admin.tentang.index', '#problem-solution')
            ->with('success', '🗑️ Item berhasil dihapus!');
    }

    public function toggleProblemSolutionItem(AboutProblemSolutionItem $item)
    {
        $item->update(['is_active' => !$item->is_active]);
        $status = $item->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "✅ Item berhasil {$status}!");
    }

    // ==========================================
    // STATISTICS CRUD
    // ==========================================

    public function storeStatistic(AboutStatisticRequest $request)
    {
        $maxOrder = AboutStatistic::max('sort_order') ?? 0;

        AboutStatistic::create([
            'number'     => $request->number,
            'label'      => $request->label,
            'sort_order' => $request->input('sort_order', $maxOrder + 1),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#statistics')
            ->with('success', '✅ Statistik berhasil ditambahkan!');
    }

    public function updateStatistic(AboutStatisticRequest $request, AboutStatistic $statistic)
    {
        $statistic->update([
            'number'     => $request->number,
            'label'      => $request->label,
            'sort_order' => $request->input('sort_order', $statistic->sort_order),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#statistics')
            ->with('success', '✅ Statistik berhasil diperbarui!');
    }

    public function destroyStatistic(AboutStatistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.tentang.index', '#statistics')
            ->with('success', '🗑️ Statistik berhasil dihapus!');
    }

    public function toggleStatistic(AboutStatistic $statistic)
    {
        $statistic->update(['is_active' => !$statistic->is_active]);
        $status = $statistic->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "✅ Statistik berhasil {$status}!");
    }
}
