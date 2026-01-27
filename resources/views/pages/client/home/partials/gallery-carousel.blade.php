<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        <h2 class="mb-6 text-2xl font-bold text-app-text text-center">
            Gallery
        </h2>

        <div class="flex gap-6 overflow-x-auto pb-2">

            @foreach ($galleries as $gallery)
                <div class="min-w-[260px] rounded-xl overflow-hidden
                            border border-card-border bg-card">

                    <img
                        src="{{ asset('storage/'.$gallery->image) }}"
                        class="h-44 w-full object-cover"
                        alt="{{ $gallery->title }}"
                    >

                    <div class="p-4">
                        <h3 class="font-semibold text-app-text">
                            {{ $gallery->title }}
                        </h3>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>
