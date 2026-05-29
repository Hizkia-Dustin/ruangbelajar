<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialAdminController extends Controller
{
    /**
     * Display a listing of the testimonials with filters and search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('display_location');
        $status = $request->input('is_active');

        $query = Testimonial::query();

        // Search name or testimonial
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('testimonial', 'like', "%{$search}%");
            });
        }

        // Filter display_location
        if ($location === 'home') {
            $query->where('tampil_di_beranda', true);
        } elseif ($location === 'about') {
            $query->where('tampil_di_tentang', true);
        } elseif ($location === 'both') {
            $query->where('tampil_di_beranda', true)->where('tampil_di_tentang', true);
        }

        // Filter is_active
        if ($status !== null && $status !== '') {
            $query->where('is_active', $status);
        }

        // Order and Paginate
        $testimonials = $query->orderBy('sort_order', 'asc')
                              ->orderBy('created_at', 'desc')
                              ->paginate(10)
                              ->withQueryString();

        return view('admin.testimonials.index', compact('testimonials', 'search', 'location', 'status'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['tampil_di_beranda'] = $request->boolean('tampil_di_beranda', false);
        $data['tampil_di_tentang'] = $request->boolean('tampil_di_tentang', false);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', '✅ Testimoni berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['tampil_di_beranda'] = $request->boolean('tampil_di_beranda', false);
        $data['tampil_di_tentang'] = $request->boolean('tampil_di_tentang', false);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', '✅ Testimoni berhasil diperbarui!');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', '🗑️ Testimoni berhasil dihapus!');
    }

    /**
     * Toggle the active status of a testimonial.
     */
    public function toggleActive(Testimonial $testimonial)
    {
        $testimonial->update([
            'is_active' => !$testimonial->is_active
        ]);

        $statusText = $testimonial->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "✅ Status testimoni {$testimonial->name} berhasil {$statusText}!");
    }

    /**
     * Toggle the featured status of a testimonial.
     */
    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update([
            'is_featured' => !$testimonial->is_featured
        ]);

        $featuredText = $testimonial->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';

        return redirect()
            ->back()
            ->with('success', "⭐ Testimoni {$testimonial->name} berhasil {$featuredText}!");
    }
}
