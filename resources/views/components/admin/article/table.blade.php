<!-- resources/views/components/admin/article/table.blade.php -->

@props([
    'articles'
])

<div class="overflow-x-auto">

    <table class="admin-table">

        <thead>
            <tr>
                <th class="w-20">Thumbnail</th>
                <th>Title</th>
                <th class="max-w-xs">Excerpt</th>
                <th>Author</th>
                <th>Status</th>
                <th>Published</th>
                <th>Created</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($articles as $article)
                <tr>

                    {{-- THUMBNAIL --}}
                    <td>
                        @if ($article->thumbnail)
                            <img
                                src="{{ asset('storage/'.$article->thumbnail) }}"
                                alt="Thumbnail"
                                class="h-12 w-16 rounded-md object-cover
                                       border border-border-soft"
                            >
                        @else
                            <div
                                class="h-12 w-16 flex items-center justify-center
                                       rounded-md border border-border-soft
                                       text-xs text-app-muted"
                            >
                                No image
                            </div>
                        @endif
                    </td>

                    {{-- TITLE --}}
                    <td class="font-medium text-app-text">
                        {{ $article->title }}
                    </td>

                    {{-- EXCERPT --}}
                    <td class="text-app-muted text-sm max-w-xs">
                        {{ Str::limit($article->excerpt ?? '-', 80) }}
                    </td>

                    {{-- AUTHOR --}}
                    <td class="text-app-muted">
                        {{ $article->author ?? '-' }}
                    </td>

                    {{-- STATUS --}}
                    <td>
                        @if ($article->is_published)
                            <span class="badge badge-success">
                                Published
                            </span>
                        @else
                            <span class="badge badge-muted">
                                Draft
                            </span>
                        @endif
                    </td>

                    {{-- PUBLISHED DATE --}}
                    <td class="text-app-muted">
                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                    </td>

                    {{-- CREATED DATE --}}
                    <td class="text-app-muted">
                        {{ $article->created_at->format('d M Y') }}
                    </td>

                    {{-- ACTION --}}
                    <td class="text-right">
                        <div class="inline-flex gap-2">

                            <a
                                href="{{ route('admin.articles.edit', $article) }}"
                                class="btn-admin"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.articles.destroy', $article) }}"
                                onsubmit="return confirm('Delete this article?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="btn-danger">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="admin-table-empty">
                        No articles found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>
