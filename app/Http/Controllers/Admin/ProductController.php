<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.admin.products.index', [
            'products' => Product::orderBy('order')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('pages.admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'content'       => 'required|string',
            'image'         => 'nullable|image|max:2048',
            'price'         => 'required|numeric|min:0',
            'is_active'     => 'required|in:0,1',

            // TEMPLATE
            'delivery_type' => 'required|in:file,link',
            'file'          => 'nullable|file|mimes:zip,rar',
            'download_url'  => 'nullable|url',
        ]);

        $validated['order'] = Product::max('order') + 1;
        $validated['is_active'] = (int) $validated['is_active'];

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        // DELIVERY
        if ($validated['delivery_type'] === 'file' && $request->hasFile('file')) {
            $validated['download_path'] = $request->file('file')
                ->store('templates', 'public');
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

    public function edit(Product $product)
    {
        return view('pages.admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'content'       => 'required|string',
            'image'         => 'nullable|image|max:2048',
            'price'         => 'required|numeric|min:0',
            'is_active'     => 'required|in:0,1',
            'order_action'  => 'nullable|in:keep,up,down,top,bottom',

            // TEMPLATE
            'delivery_type' => 'required|in:file,link',
            'file'          => 'nullable|file|mimes:zip,rar',
            'download_url'  => 'nullable|url',
        ]);

        DB::transaction(function () use ($request, $product) {

            // IMAGE
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $request->file('image')
                    ->store('products', 'public');
            }

            // DELIVERY
            if ($request->delivery_type === 'file' && $request->hasFile('file')) {
                if ($product->download_path) {
                    Storage::disk('public')->delete($product->download_path);
                }

                $product->download_path = $request->file('file')
                    ->store('templates', 'public');
                $product->download_url = null;
            }

            if ($request->delivery_type === 'link') {
                $product->download_path = null;
                $product->download_url = $request->download_url;
            }

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

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->download_path) {
            Storage::disk('public')->delete($product->download_path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
