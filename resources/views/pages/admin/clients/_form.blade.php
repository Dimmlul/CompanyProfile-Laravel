<div class="grid grid-cols-1 gap-4">

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Client Name
        </label>
        <input type="text" name="name" required
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Logo
        </label>
        <input type="file" name="logo"
            class="block w-full text-xs
                   file:rounded-md file:bg-btn-primary
                   file:px-3 file:py-1.5 file:text-btn-text
                   hover:file:bg-btn-primary-hover">
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Website
        </label>
        <input type="url" name="website"
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
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
