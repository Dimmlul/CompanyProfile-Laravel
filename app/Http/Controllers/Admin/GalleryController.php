<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a paginated list of gallery items.
     *
     * Responsibilities:
     * - Retrieve gallery items ordered by the custom `order` column
     * - Apply pagination
     * - Render the admin gallery index page
     */
    public function index()
    {
        return view('pages.admin.gallery.index', [
            'galleries' => Gallery::orderBy('order')->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new gallery item.
     *
     * Responsibilities:
     * - Render the gallery creation form
     */
    public function create()
    {
        return view('pages.admin.gallery.create');
    }

    /**
     * Store a newly created gallery item in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Assign display order automatically
     * - Cast active status to boolean
     * - Handle image upload
     * - Persist gallery data to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'caption'   => 'nullable|string',
            'category'  => 'nullable|string|max:100',
            'image'     => 'required|image|max:2048',
            'is_active' => 'required|in:0,1',
        ]);

        /**
         * Assign the next available order value.
         * New gallery items are placed at the bottom by default.
         */
        $validated['order'] = Gallery::max('order') + 1;

        /**
         * Ensure boolean casting for the active state.
         */
        $validated['is_active'] = (bool) $validated['is_active'];

        /**
         * Handle gallery image upload.
         */
        $validated['image'] = $request->file('image')->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery added');
    }

    /**
     * Show the form for editing the specified gallery item.
     *
     * Responsibilities:
     * - Load the gallery data
     * - Render the edit form
     */
    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item in storage.
     *
     * Responsibilities:
     * - Validate updated request data
     * - Handle gallery reordering actions
     * - Replace image if a new one is uploaded
     * - Persist updated gallery data
     */
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

        /**
         * Handle gallery order movement if an order action is provided.
         */
        if ($request->order_action) {
            $this->reorder($gallery, $request->order_action);
        }

        /**
         * Handle image replacement.
         * If a new image is uploaded:
         * - Delete the existing image file
         * - Store the new image
         */
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        /**
         * Remove order_action from the validated data
         * to prevent unintended database updates.
         */
        unset($validated['order_action']);

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery updated');
    }

    /**
     * Handle gallery order rearrangement.
     *
     * Supported actions:
     * - top:    Move gallery item to the first position
     * - bottom: Move gallery item to the last position
     * - up:     Move gallery item one position up
     * - down:   Move gallery item one position down
     *
     * This method adjusts surrounding records to maintain
     * a consistent ordering sequence.
     */
    private function reorder(Gallery $gallery, string $action)
    {
        $max = Gallery::max('order');

        /**
         * Shift surrounding gallery items based on the selected action.
         */
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

        /**
         * Assign the new order value to the current gallery item.
         */
        $gallery->order = match ($action) {
            'top'    => 1,
            'bottom' => $max,
            'up'     => max(1, $gallery->order - 1),
            'down'   => min($max, $gallery->order + 1),
        };

        $gallery->save();
    }

    /**
     * Remove the specified gallery item from storage.
     *
     * Responsibilities:
     * - Delete the gallery image file
     * - Remove the gallery record from the database
     */
    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Gallery deleted');
    }
}
