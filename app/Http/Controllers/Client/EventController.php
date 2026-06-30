<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display the client events listing page.
     *
     * Responsibilities:
     * - Separate upcoming and past events
     * - Apply different sorting strategies for each group
     * - Paginate both datasets independently
     * - Render the client events index page
     */
    public function index()
    {
        /**
         * Define today's date for event comparison.
         */
        $today = Carbon::today();

        /**
         * ===============================
         * UPCOMING EVENTS
         *
         * Criteria:
         * - Active events only
         * - Events happening today or in the future
         * - Sorted by the nearest upcoming date first
         * ===============================
         */
        $upcomingEvents = Event::query()
            ->where('is_active', true)
            ->whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->paginate(6, ['*'], 'upcoming');

        /**
         * ===============================
         * PAST EVENTS
         *
         * Criteria:
         * - Active events only
         * - Events that have already ended
         * - Sorted by the most recent past date first
         * ===============================
         */
        $pastEvents = Event::query()
            ->where('is_active', true)
            ->whereDate('start_date', '<', $today)
            ->orderBy('start_date', 'desc')
            ->paginate(6, ['*'], 'past');

        return view('pages.client.events.index', compact(
            'upcomingEvents',
            'pastEvents'
        ));
    }

    /**
     * Display a single event detail page.
     *
     * Responsibilities:
     * - Ensure the event is active and publicly accessible
     * - Render the client event detail page
     */
    public function show(Event $event)
    {
        /**
         * Prevent access to inactive events.
         */
        abort_if(! $event->is_active, 404);

        $related = Event::query()
            ->where('is_active', true)
            ->whereKeyNot($event->getKey())
            ->orderByRaw('ABS(DATEDIFF(start_date, ?))', [$event->start_date])
            ->take(3)
            ->get();

        return view('pages.client.events.show', compact('event', 'related'));
    }
}
