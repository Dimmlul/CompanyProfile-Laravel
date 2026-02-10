<div class="grid grid-cols-1 gap-4">

    <!-- PRODUCT NAME -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Product Name
        </label>
        <input type="text" name="name" required
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <!-- SHORT DESCRIPTION -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Short Description
        </label>
        <textarea name="description" rows="2"
            class="w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 py-2 text-sm text-white/90"></textarea>
    </div>

    <!-- CONTENT -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Product Content
        </label>
        <textarea name="content" rows="4" required
            class="w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 py-2 text-sm text-white/90"></textarea>
    </div>

    <!-- IMAGE + PREVIEW -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Product Image
        </label>

        <!-- PREVIEW -->
        <img
            id="image-preview"
            class="mb-2 hidden h-32 w-48 rounded-lg object-cover
                   border border-gray-700"
        >

        <input
            type="file"
            name="image"
            accept="image/*"
            onchange="
                const img = document.getElementById('image-preview');
                const file = this.files[0];
                if (file) {
                    img.src = URL.createObjectURL(file);
                    img.classList.remove('hidden');
                } else {
                    img.classList.add('hidden');
                }
            "
            class="block w-full text-xs
                   file:rounded-md file:bg-btn-primary
                   file:px-3 file:py-1.5 file:text-btn-text
                   hover:file:bg-btn-primary-hover"
        >
    </div>

    <!-- PRICE -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Price
        </label>
        <input type="number" name="price" required
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90">
    </div>

    <!-- DELIVERY TYPE -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Delivery Type
        </label>

        <div class="flex gap-6 text-xs text-gray-300">
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="radio"
                    name="delivery_type"
                    value="file"
                    checked
                    onclick="
                        document.getElementById('file-field').style.display = 'block';
                        document.getElementById('link-field').style.display = 'none';
                        document.getElementById('file_input').required = true;
                        document.getElementById('download_url').required = false;
                    "
                >
                Upload File
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="radio"
                    name="delivery_type"
                    value="link"
                    onclick="
                        document.getElementById('file-field').style.display = 'none';
                        document.getElementById('link-field').style.display = 'block';
                        document.getElementById('file_input').required = false;
                        document.getElementById('download_url').required = true;
                    "
                >
                Download URL
            </label>
        </div>
    </div>

    <!-- FILE UPLOAD -->
    <div id="file-field">
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Upload File (ZIP / RAR)
        </label>
        <input
            id="file_input"
            type="file"
            name="file"
            accept=".zip,.rar"
            required
            class="block w-full text-xs
                   file:rounded-md file:bg-btn-primary
                   file:px-3 file:py-1.5 file:text-btn-text
                   hover:file:bg-btn-primary-hover"
        >
    </div>

    <!-- DOWNLOAD URL -->
    <div id="link-field" style="display:none;">
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Download URL
        </label>
        <input
            id="download_url"
            type="url"
            name="download_url"
            placeholder="https://drive.google.com / github / figma"
            class="h-10 w-full rounded-lg border border-gray-700 bg-transparent
                   px-3 text-sm text-white/90"
        >
    </div>

    <!-- STATUS -->
    <div>
        <label class="mb-1 block text-xs font-medium text-gray-400">
            Status
        </label>
        <div class="flex gap-5 text-xs text-gray-300">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1"> Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0" checked> Inactive
            </label>
        </div>
    </div>

</div>
