<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        return view('pages.admin.products.index', [
            'products' => Product::orderBy('order')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('pages.admin.products.create');
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'required|in:0,1',
        ]);

        // auto order (AMAN, TANPA DUPLIKAT)
        $validated['order'] = Product::max('order') + 1;
        $validated['is_active'] = (int) $validated['is_active'];

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('pages.admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'required|in:0,1',
            'order_action'=> 'nullable|in:keep,up,down,top,bottom',
        ]);

        $validated['is_active'] = (int) $validated['is_active'];

        DB::transaction(function () use ($request, $product) {

            $action = $request->input('order_action', 'keep');
            $currentOrder = $product->order;
            $maxOrder = Product::max('order');

            if ($action !== 'keep') {

                if ($action === 'up' && $currentOrder > 1) {
                    Product::where('order', $currentOrder - 1)
                        ->update(['order' => $currentOrder]);
                    $product->order = $currentOrder - 1;
                }

                if ($action === 'down' && $currentOrder < $maxOrder) {
                    Product::where('order', $currentOrder + 1)
                        ->update(['order' => $currentOrder]);
                    $product->order = $currentOrder + 1;
                }

                if ($action === 'top') {
                    Product::where('order', '<', $currentOrder)
                        ->increment('order');
                    $product->order = 1;
                }

                if ($action === 'bottom') {
                    Product::where('order', '>', $currentOrder)
                        ->decrement('order');
                    $product->order = $maxOrder;
                }
            }

            // IMAGE
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $product->image = $request->file('image')
                    ->store('products', 'public');
            }

            $product->fill($request->only([
                'name', 'description', 'content', 'price', 'is_active'
            ]));

            $product->save();
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /* ===============================================================
    | ORDER HELPERS (AMAN, NO DUPLICATE)
    =============================================================== */

    protected function moveUp(Product $product)
    {
        $swap = Product::where('order', '<', $product->order)
            ->orderByDesc('order')
            ->first();

        if ($swap) {
            [$product->order, $swap->order] = [$swap->order, $product->order];
            $product->save();
            $swap->save();
        }
    }

    protected function moveDown(Product $product)
    {
        $swap = Product::where('order', '>', $product->order)
            ->orderBy('order')
            ->first();

        if ($swap) {
            [$product->order, $swap->order] = [$swap->order, $product->order];
            $product->save();
            $swap->save();
        }
    }

    protected function moveToTop(Product $product)
    {
        Product::where('order', '<', $product->order)->increment('order');
        $product->order = 1;
        $product->save();
    }

    protected function moveToBottom(Product $product)
    {
        $max = Product::max('order');

        Product::where('order', '>', $product->order)->decrement('order');
        $product->order = $max;
        $product->save();
    }
}
