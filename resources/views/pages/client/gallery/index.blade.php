<!-- resources/views/pages/client/gallery/index.blade.php -->
@extends('layouts.app')

@section('title', 'Gallery')

@section('content')

<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        <!-- SECTION TITLE -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-app-text">
                Gallery
            </h1>
            <p class="mt-2 text-app-muted">
                Our activities and documentation
            </p>
        </div>

        <!-- GALLERY GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($galleries as $gallery)
                <div
                    class="group overflow-hidden rounded-xl
                           border border-card-border bg-card
                           transition hover:shadow-lg">

                    <!-- IMAGE -->
                    <img
                        src="{{ asset('storage/'.$gallery->image) }}"
                        alt="{{ $gallery->title }}"
                        class="h-56 w-full object-cover
                               transition-transform duration-300
                               group-hover:scale-105"
                    >

                    <!-- CONTENT -->
                    <div class="p-4">
                        <h3 class="font-semibold text-app-text">
                            {{ $gallery->title }}
                        </h3>

                        @if ($gallery->caption)
                            <p class="mt-1 text-sm text-app-muted">
                                {{ $gallery->caption }}
                            </p>
                        @endif
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>

@endsection
