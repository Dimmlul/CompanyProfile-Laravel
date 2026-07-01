@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
<x-common.component-card title="Gallery">

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage gallery images
        </p>

        {{-- ✅ ADD IMAGE BUTTON --}}
        <a href="{{ route('admin.gallery.create') }}"
           class="btn-primary">
            + Add Image
        </a>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @forelse ($galleries as $gallery)
            <div class="rounded-xl border border-app-border overflow-hidden">

                <img
                    src="{{ asset('storage/'.$gallery->image) }}"
                    class="h-40 w-full object-cover"
                >

                <div class="p-3 space-y-1 text-sm">

                    <p class="font-medium">
                        {{ $gallery->title ?? 'Untitled' }}
                    </p>

                    <p class="text-xs text-app-muted">
                        Order: {{ $gallery->order }}
                    </p>

                    <div class="mt-3 flex justify-between gap-2">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}"
                           class="btn-admin text-xs">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.gallery.destroy', $gallery) }}"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn-danger text-xs">
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
