<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a paginated list of products.
     *
     * Responsibilities:
     * - Retrieve products ordered by the custom `order` column
     * - Apply pagination
     * - Render the admin products index page
     */
    public function index()
    {
        return view('pages.admin.products.index', [
            'products' => Product::orderBy('order')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * Responsibilities:
     * - Render the product creation form
     */
    public function create()
    {
        return view('pages.admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Assign display order automatically
     * - Handle product image upload
     * - Handle delivery configuration (file or external link)
     * - Persist product data to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'content'       => 'required|string',
            'image'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price'         => 'required|numeric|min:0',
            'is_active'     => 'required|in:0,1',

            // Delivery configuration
            'delivery_type' => 'required|in:file,link',
            'file'          => 'nullable|file|mimes:zip,rar',
            'download_url'  => 'nullable|url',
        ]);

        /**
         * A product must actually have something to deliver, otherwise a
         * customer could pay and receive nothing. There's no existing
         * file/URL yet on create, so the matching one must be provided now.
         */
        if ($validated['delivery_type'] === 'file' && ! $request->hasFile('file')) {
            throw ValidationException::withMessages([
                'file' => 'Upload a template file, or switch delivery to External Link.',
            ]);
        }

        if ($validated['delivery_type'] === 'link' && blank($validated['download_url'] ?? null)) {
            throw ValidationException::withMessages([
                'download_url' => 'Provide a download URL, or switch delivery to Upload File.',
            ]);
        }

        /**
         * Assign the next available order value.
         * New products are placed at the bottom by default.
         */
        $validated['order'] = Product::max('order') + 1;

        /**
         * Ensure proper casting for the active state.
         */
        $validated['is_active'] = (int) $validated['is_active'];

        /**
         * Handle product image upload.
         */
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        /**
         * Handle delivery configuration.
         *
         * - File delivery:
         *   Upload the downloadable file and clear the external URL.
         * - Link delivery:
         *   Clear any stored file path and rely on the external URL.
         */
        if ($validated['delivery_type'] === 'file' && $request->hasFile('file')) {
            // Paid files live on the private disk so they can't be downloaded without checkout.
            $validated['download_path'] = $request->file('file')
                ->store('templates', 'local');
            $validated['download_url'] = null;
        }

        if ($validated['delivery_type'] === 'link') {
            $validated['download_path'] = null;
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     *
     * Responsibilities:
     * - Load the product data
     * - Render the edit form
     */
    public function edit(Product $product)
    {
        return view('pages.admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * Responsibilities:
     * - Validate updated request data
     * - Handle image replacement
     * - Handle delivery updates (file or external link)
     * - Perform all file and database operations atomically
     * - Persist updated product data
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'content'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price'         => 'required|numeric|min:0',
            'is_active'     => 'required|in:0,1',
            'order_action'  => 'nullable|in:keep,up,down,top,bottom',

            // Delivery configuration
            'delivery_type' => 'required|in:file,link',
            'file'          => 'nullable|file|mimes:zip,rar',
            'download_url'  => 'nullable|url',
        ]);

        /**
         * A product must always have something to deliver. Unlike create,
         * an existing file/URL already on the product also counts — the
         * admin isn't forced to re-upload just to save an unrelated change.
         */
        if ($validated['delivery_type'] === 'file' && ! $request->hasFile('file') && ! $product->download_path) {
            throw ValidationException::withMessages([
                'file' => 'Upload a template file, or switch delivery to External Link.',
            ]);
        }

        if ($validated['delivery_type'] === 'link' && blank($validated['download_url'] ?? null) && ! $product->download_url) {
            throw ValidationException::withMessages([
                'download_url' => 'Provide a download URL, or switch delivery to Upload File.',
            ]);
        }

        /**
         * Perform update operations within a database transaction
         * to ensure consistency between files and database records.
         */
        DB::transaction(function () use ($request, $product) {

            /**
             * Handle product image replacement.
             */
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $request->file('image')
                    ->store('products', 'public');
            }

            /**
             * Handle delivery configuration updates.
             *
             * - File delivery:
             *   Replace the downloadable file and remove the old one.
             * - Link delivery:
             *   Remove any stored file and update the external URL.
             */
            if ($request->delivery_type === 'file' && $request->hasFile('file')) {
                if ($product->download_path) {
                    // Remove the old file from whichever disk it lives on (legacy files were public).
                    Storage::disk('local')->delete($product->download_path);
                    Storage::disk('public')->delete($product->download_path);
                }

                // Paid files live on the private disk so they can't be downloaded without checkout.
                $product->download_path = $request->file('file')
                    ->store('templates', 'local');
                $product->download_url = null;
            }

            if ($request->delivery_type === 'link') {
                $product->download_path = null;
                $product->download_url = $request->download_url;
            }

            /**
             * Update core product attributes.
             */
            $product->fill($request->only([
                'name',
                'description',
                'content',
                'price',
                'delivery_type',
                'is_active',
            ]));

            $product->save();
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     *
     * Responsibilities:
     * - Delete the product image file if it exists
     * - Delete the downloadable file if it exists
     * - Remove the product record from the database
     */
    public function destroy(Product $product)
    {
        // Block deletion when the product is part of existing orders (protects purchase history);
        // deactivate it instead so past buyers keep their records and downloads.
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'This product has orders. Set it to Inactive instead of deleting.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->download_path) {
            // Paid files may live on either disk (new = private, legacy = public).
            Storage::disk('local')->delete($product->download_path);
            Storage::disk('public')->delete($product->download_path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
