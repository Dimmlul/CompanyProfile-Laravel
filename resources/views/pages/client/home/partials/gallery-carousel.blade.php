<!-- Gallery Section -->
<section class="py-20 overflow-hidden">
    <h2 class="text-3xl font-semibold text-center mx-auto">
        Our Latest Creations
    </h2>

    <p class="text-sm text-slate-500 text-center mt-2 max-w-lg mx-auto">
        A visual collection of our most recent works –
        each piece crafted with intention, emotion, and style.
    </p>

    <div class="flex items-center gap-6 h-[400px] w-full max-w-5xl mt-10 mx-auto">
        @foreach ($galleries as $gallery)
            <div
                class="relative group flex-grow transition-all duration-500 w-56 h-[400px] hover:w-full"
            >
                <img
                    class="h-full w-full object-cover object-center"
                    src="{{ asset('storage/' . $gallery->image) }}"
                    alt="{{ $gallery->title }}"
                >

                <div
                    class="absolute inset-0 flex flex-col justify-end p-10
                           text-white bg-black/50 opacity-0
                           group-hover:opacity-100
                           transition-all duration-300"
                >
                    <h3 class="text-2xl font-semibold">
                        {{ $gallery->title }}
                    </h3>

                    @if (!empty($gallery->description))
                        <p class="text-sm mt-2">
                            {{ $gallery->description }}
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
