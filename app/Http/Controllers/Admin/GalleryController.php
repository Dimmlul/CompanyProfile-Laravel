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
            'galleries' => Gallery::orderBy('order')->paginate(12),
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
            'image'     => 'required|image|max:2048',
            'is_active' => 'required|in:0,1',
        ]);

        $validated['order'] = Gallery::max('order') + 1;
        $validated['is_active'] = (bool) $validated['is_active'];
        $validated['image'] = $request->file('image')->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery added');
    }

    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'        => 'nullable|string|max:255',
            'caption'      => 'nullable|string',
            'category'     => 'nullable|string|max:100',
            'is_active'    => 'required|in:0,1',
            'image'        => 'nullable|image|max:2048',
            'order_action' => 'nullable|in:top,up,down,bottom',
        ]);

        // ==== HANDLE ORDER ====
        if ($request->order_action) {
            $this->reorder($gallery, $request->order_action);
        }

        // ==== IMAGE ====
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        unset($validated['order_action']);

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery updated');
    }

    private function reorder(Gallery $gallery, string $action)
    {
        $max = Gallery::max('order');

        match ($action) {
            'top' => Gallery::where('order', '<', $gallery->order)
                ->increment('order'),

            'bottom' => Gallery::where('order', '>', $gallery->order)
                ->decrement('order'),

            'up' => Gallery::where('order', $gallery->order - 1)
                ->increment('order'),

            'down' => Gallery::where('order', $gallery->order + 1)
                ->decrement('order'),
        };

        $gallery->order = match ($action) {
            'top'    => 1,
            'bottom' => $max,
            'up'     => max(1, $gallery->order - 1),
            'down'   => min($max, $gallery->order + 1),
        };

        $gallery->save();
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Gallery deleted');
    }
}
