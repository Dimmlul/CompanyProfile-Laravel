@props([
    'article' => null,
    'action',
    'method' => 'POST',
])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-5">

        <x-common.form.input
            label="Title"
            name="title"
            :value="$article?->title"
            required
        />

        <x-common.form.textarea
            label="Excerpt"
            name="excerpt"
            rows="3"
            :value="$article?->excerpt"
        />

        <x-common.form.textarea
            label="Content"
            name="content"
            rows="8"
            :value="$article?->content"
        />

        <x-common.form.file
            label="Thumbnail"
            name="thumbnail"
        />

        @if ($article?->thumbnail)
            <img
                src="{{ asset('storage/'.$article->thumbnail) }}"
                class="h-24 rounded-lg border border-white/10 object-cover"
            >
        @endif

        <x-common.form.input
            label="Author"
            name="author"
            :value="$article?->author ?? auth()->user()->name"
        />

        <x-common.form.date-picker
            label="Publish Date"
            name="published_at"
            :value="$article?->published_at?->format('Y-m-d\TH:i')"
        />

        <x-common.form.radio-group
            label="Status"
            name="is_published"
            :value="$article?->is_published ?? 0"
            :options="[1 => 'Published', 0 => 'Draft']"
        />

        <div class="pt-4">
            <button class="btn-primary">
                {{ $method === 'POST' ? 'Save Article' : 'Update Article' }}
            </button>
        </div>

    </div>
</form>
