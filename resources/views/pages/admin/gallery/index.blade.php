{{-- FILE: resources/views/pages/admin/gallery/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')

<x-common.component-card title="Gallery">

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage gallery images
        </p>

        <a href="{{ route('admin.gallery.create') }}"
           class="btn-primary">
            + Add Image
        </a>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

        @forelse ($galleries as $gallery)
            <div class="rounded-xl border border-[var(--color-border-soft)] admin-scope overflow-hidden">

                <img
                    src="{{ asset('storage/'.$gallery->image) }}"
                    class="h-40 w-full object-cover"
                    alt="{{ $gallery->title }}"
                >

                <div class="p-3 space-y-1">

                    <p class="text-sm font-medium">
                        {{ $gallery->title ?? 'Untitled' }}
                    </p>

                    <p class="text-xs text-text-muted">
                        {{ $gallery->category ?? '-' }}
                    </p>

                    @if ($gallery->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Inactive</span>
                    @endif

                    <div class="mt-3 flex justify-between gap-2">

                        <a href="{{ route('admin.gallery.edit', $gallery) }}"
                           class="btn-admin text-xs px-3 py-1.5">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.gallery.destroy', $gallery) }}"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn-danger text-xs px-3 py-1.5">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full admin-table-empty">
                No gallery items found
            </div>
        @endforelse

    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>

</x-common.component-card>

@endsection
