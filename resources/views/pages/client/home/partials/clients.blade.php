<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 text-center">

        <h2 class="mb-8 text-2xl font-bold text-app-text">
            Our Clients
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 items-center">
            @foreach ($clients as $client)
                <div class="p-4 border border-card-border rounded-lg bg-card">
                    <img
                        src="{{ asset('storage/'.$client->logo) }}"
                        alt="{{ $client->name }}"
                        class="mx-auto h-12 object-contain"
                    >
                </div>
            @endforeach
        </div>

    </div>
</section>
