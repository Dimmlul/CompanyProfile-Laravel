<div class="grid grid-cols-1 gap-4">

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Title
        </label>
        <input
            type="text"
            name="title"
            required
            class="h-10 w-full rounded-lg
                   border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90
                   focus:border-brand-400
                   focus:ring-2 focus:ring-brand-500/20">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Excerpt (optional)
        </label>
        <textarea
            name="excerpt"
            rows="2"
            class="w-full rounded-lg
                   border border-gray-700 bg-transparent
                   px-3 py-2 text-sm text-white/90"></textarea>
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Content
        </label>
        <textarea
            name="content"
            rows="4"
            required
            class="w-full rounded-lg
                   border border-gray-700 bg-transparent
                   px-3 py-2 text-sm text-white/90"></textarea>
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Thumbnail
        </label>
        <input
            type="file"
            name="thumbnail"
            class="block w-full text-xs
                   file:rounded-md
                   file:bg-btn-primary
                   file:px-3 file:py-1.5
                   file:text-btn-text
                   hover:file:bg-btn-primary-hover">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Author
        </label>
        <input
            type="text"
            name="author"
            value="{{ auth()->user()->name ?? '' }}"
            class="h-10 w-full rounded-lg
                   border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Publish Date
        </label>
        <input
            type="datetime-local"
            name="published_at"
            class="h-10 w-full rounded-lg
                   border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Publish Status
        </label>
        <div class="flex gap-5 text-xs text-gray-300">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_published" value="1">
                Publish
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_published" value="0" checked>
                Draft
            </label>
        </div>
    </div>

</div>
