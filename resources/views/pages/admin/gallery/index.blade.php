<!-- resources/views/pages/admin/gallery/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')

<x-common.component-card title="Gallery">

    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-app-muted">
            Manage gallery images
        </p>

        <a href="{{ route('admin.gallery.create') }}"
           class="rounded-lg bg-btn-primary px-4 py-2 text-sm
                  font-medium text-btn-text hover:bg-btn-primary-hover">
            + Add Image
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @forelse ($galleries as $gallery)
            <div class="overflow-hidden rounded-lg
                        border border-gray-700 bg-app-bg">

                <img
                    src="{{ asset('storage/'.$gallery->image) }}"
                    class="h-40 w-full object-cover"
                >

                <div class="p-3 space-y-1">

                    <div class="text-sm font-medium text-app-text">
                        {{ $gallery->title ?? 'Untitled' }}
                    </div>

                    <div class="text-xs text-app-muted">
                        {{ $gallery->category ?? '-' }}
                    </div>

                    <div class="text-xs font-semibold
                        {{ $gallery->is_active ? 'text-green-400' : 'text-red-400' }}">
                        {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                    </div>

                    <div class="mt-2 flex justify-between">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}"
                           class="rounded bg-btn-primary px-2 py-1
                                  text-xs text-btn-text">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.gallery.destroy', $gallery) }}"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="rounded bg-danger px-2 py-1
                                       text-xs text-white">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-app-muted">
                No gallery items found.
            </p>
        @endforelse

    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>

</x-common.component-card>

@endsection
