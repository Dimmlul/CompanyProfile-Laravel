<div class="grid grid-cols-1 gap-4">

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Event Title
        </label>
        <input
            type="text"
            name="title"
            required
            class="h-10 w-full rounded-lg
                   border border-gray-700
                   bg-card-bg
                   px-3 text-sm text-white
                   focus:border-brand-main focus:outline-none"
        >
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Short Description
        </label>
        <textarea
            name="description"
            rows="2"
            class="w-full rounded-lg
                   border border-gray-700
                   bg-card-bg
                   px-3 py-2 text-sm text-white"
        ></textarea>
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
                   border border-gray-700
                   bg-card-bg
                   px-3 py-2 text-sm text-white"
        ></textarea>
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Event Image
        </label>
        <input
            type="file"
            name="image"
            class="block w-full text-xs text-gray-300
                   file:rounded-md
                   file:bg-brand-main
                   file:px-3 file:py-1.5
                   file:text-brand-text
                   hover:file:bg-brand-hover"
        >
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Start Date
        </label>
        <input
            type="datetime-local"
            name="start_date"
            class="h-10 w-full rounded-lg
                   border border-gray-700
                   bg-card-bg
                   px-3 text-sm text-white"
        >
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            End Date
        </label>
        <input
            type="datetime-local"
            name="end_date"
            class="h-10 w-full rounded-lg
                   border border-gray-700
                   bg-card-bg
                   px-3 text-sm text-white"
        >
    </div>

    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Status
        </label>
        <div class="flex gap-5 text-xs text-gray-300">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1" checked>
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0">
                Inactive
            </label>
        </div>
    </div>

</div>
