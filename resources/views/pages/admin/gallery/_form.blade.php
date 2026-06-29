<div class="grid grid-cols-1 gap-4">

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Title
        </label>
        <input type="text" name="title"
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Image
        </label>
        <input type="file" name="image" required
            class="block w-full text-xs
                   file:rounded-md file:bg-brand-main
                   file:px-3 file:py-1.5 file:text-brand-text
                   hover:file:bg-brand-hover">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Caption
        </label>
        <textarea name="caption" rows="2"
            class="w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 py-2 text-sm text-white/90"></textarea>
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Status
        </label>
        <div class="flex gap-5 text-xs text-gray-300">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1" checked> Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0"> Inactive
            </label>
        </div>
    </div>

</div>
