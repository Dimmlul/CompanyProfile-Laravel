<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return view('pages.admin.gallery.index', [
            'galleries' => Gallery::orderBy('order')
                ->orderByDesc('created_at')
                ->paginate(12),
        ]);
    }

    public function create()
    {
        return view('pages.admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'caption'   => 'nullable|string',
            'category'  => 'nullable|string|max:100',
            'order'     => 'nullable|integer',
            'is_active' => 'required|in:0,1',
            'image'     => 'required|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $validated['image'] = $request->file('image')->store('gallery', 'public');
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = (bool) $validated['is_active'];

        Gallery::create($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery created successfully.');
    }



    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'caption'   => 'nullable|string',
            'category'  => 'nullable|string|max:100',
            'order'     => 'nullable|integer',
            'is_active' => 'required|in:0,1',
        ]);

        $validated['order'] = $validated['order'] ?? $gallery->order;
        $validated['is_active'] = $request->input('is_active', $gallery->is_active);

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery deleted successfully.');
    }
}
