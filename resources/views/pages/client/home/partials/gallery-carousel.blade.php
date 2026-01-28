<!-- Gallery Section -->
<section class="py-20 overflow-hidden">
    <h2 class="mb-12 text-center text-2xl font-semibold">
        Gallery
    </h2>

    <div class="gallery-marquee">
        <div class="gallery-track">
            @foreach ($galleries as $gallery)
                <div class="gallery-item">
                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                    >
                    <p>{{ $gallery->title }}</p>
                </div>
            @endforeach

            {{-- DUPLICATE ITEMS FOR SMOOTH LOOP --}}
            @foreach ($galleries as $gallery)
                <div class="gallery-item">
                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                    >
                    <p>{{ $gallery->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
