<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a paginated list of events.
     *
     * Responsibilities:
     * - Retrieve events ordered by start date (latest first)
     * - Apply pagination
     * - Render the admin events index page
     */
    public function index()
    {
        return view('pages.admin.events.index', [
            'events' => Event::orderByDesc('start_date')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new event.
     *
     * Responsibilities:
     * - Render the event creation form
     */
    public function create()
    {
        return view('pages.admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Cast active status to boolean
     * - Handle event image upload (if provided)
     * - Persist event data to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'required|string',
            'location'    => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_active'   => 'required|in:0,1',
            'image'       => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        /**
         * Ensure boolean casting for the active state.
         */
        $validated['is_active'] = (bool) $validated['is_active'];

        /**
         * Handle event image upload.
         * Store the image in public storage if provided.
         */
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('events', 'public');
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing the specified event.
     *
     * Responsibilities:
     * - Load the event data
     * - Render the edit form
     */
    public function edit(Event $event)
    {
        return view('pages.admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     *
     * Responsibilities:
     * - Validate updated request data
     * - Cast active status to boolean
     * - Replace event image if a new one is uploaded
     * - Persist updated event data to the database
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'required|string',
            'location'    => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_active'   => 'required|in:0,1',
            'image'       => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        /**
         * Ensure boolean casting for the active state.
         */
        $validated['is_active'] = (bool) $validated['is_active'];

        /**
         * Handle event image replacement.
         * If a new image is uploaded:
         * - Delete the existing image file
         * - Store the new image
         */
        if ($request->hasFile('image')) {

            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $validated['image'] = $request->file('image')
                ->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     *
     * Responsibilities:
     * - Delete the event image file if it exists
     * - Remove the event record from the database
     */
    public function destroy(Event $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
