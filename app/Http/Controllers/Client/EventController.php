<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        /**
         * ===============================
         * UPCOMING EVENTS
         * - Hari ini & yang akan datang
         * - Urut dari yang PALING DEKAT
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
         * - Yang sudah lewat
         * - Urut dari yang PALING BARU
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

    public function show(Event $event)
    {
        abort_if(!$event->is_active, 404);

        return view('pages.client.events.show', compact('event'));
    }
}
