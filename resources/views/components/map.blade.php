@props([
    'lat' => null,
    'lng' => null,
    'address' => null,   // used for the geocode fallback + Google Maps link
    'label' => null,     // marker popup text
    'zoom' => 15,
    'height' => '340px',
])

@php
    $mapId = 'map-'.\Illuminate\Support\Str::random(8);
    $hasCoords = filled($lat) && filled($lng);
    $gmaps = $hasCoords
        ? "https://www.google.com/maps/search/?api=1&query={$lat},{$lng}"
        : (filled($address) ? 'https://www.google.com/maps/search/?api=1&query='.urlencode($address) : null);
@endphp

{{-- Leaflet assets, loaded once per page even if several maps are shown --}}
@once
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endonce

<div>
    <div {{ $attributes->class('overflow-hidden rounded-2xl border border-app-border') }}>
        <div id="{{ $mapId }}" style="height: {{ $height }}; width: 100%; z-index: 0;"></div>
    </div>

    @if ($gmaps)
        <a href="{{ $gmaps }}" target="_blank" rel="noopener"
           class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent hover:underline">
            Open in Google Maps
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    @endif
</div>

<script>
(function () {
    var id = @js($mapId);

    function init() {
        // Leaflet may not have finished loading yet — retry shortly.
        if (typeof L === 'undefined') return setTimeout(init, 100);

        var el = document.getElementById(id);
        if (!el || el.dataset.ready) return;
        el.dataset.ready = '1';

        var map = L.map(el, { scrollWheelZoom: false });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19,
        }).addTo(map);

        function place(lat, lng) {
            map.setView([lat, lng], {{ (int) $zoom }});
            var marker = L.marker([lat, lng]).addTo(map);
            @if ($label) marker.bindPopup(@js($label)); @endif
        }

        @if ($hasCoords)
            place({{ (float) $lat }}, {{ (float) $lng }});
        @elseif (filled($address))
            map.setView([-2, 118], 4); // Indonesia, until geocoding resolves
            fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(@js($address)))
                .then(function (r) { return r.json(); })
                .then(function (d) { if (d && d[0]) place(parseFloat(d[0].lat), parseFloat(d[0].lon)); })
                .catch(function () {});
        @else
            map.setView([-2, 118], 4);
        @endif
    }

    if (document.readyState !== 'loading') init();
    else document.addEventListener('DOMContentLoaded', init);
})();
</script>
