<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockLog;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter')) {
            match($request->filter) {
                'out_of_stock' => $query->where('stock', 0),
                'low_stock'    => $query->whereBetween('stock', [1, 15]),
                'in_stock'     => $query->where('stock', '>=', 16),
                default        => null
            };
        }

        $products = $query->get();
        $categories = Category::all();
        $alerts = Product::where('stock', '<', 16)->get();
        $stockLogs = StockLog::with('product')->latest()->take(50)->get();

        return view('admin.inventory', compact('products', 'categories', 'alerts', 'stockLogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'        => 'required|string|max:255',
            'description'         => 'nullable|string',
            'description_detailed'=> 'nullable|string',
            'category_id'         => 'nullable|exists:categories,category_id',
            'price'               => 'required|numeric|min:0',
            'stock'               => 'required|integer|min:0',
            'image_url'           => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $product = Product::create($request->all());

        StockLog::create([
            'product_id' => $product->product_id,
            'change'     => $product->stock,
            'reason'     => 'initial stock',
        ]);

        return back()->with('success', 'Product added.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'        => 'required|string|max:255',
            'description'         => 'nullable|string',
            'description_detailed'=> 'nullable|string',
            'category_id'         => 'nullable|exists:categories,category_id',
            'price'               => 'required|numeric|min:0',
            'stock'               => 'required|integer|min:0',
            'image_url'           => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $oldStock = $product->stock;
        $product->update($request->all());
        $change = $product->stock - $oldStock;

        if ($change !== 0) {
            StockLog::create([
                'product_id' => $product->product_id,
                'change'     => $change,
                'reason'     => 'manual update',
            ]);
        }

        return back()->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    public function restock(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product->increment('stock', $request->quantity);

        StockLog::create([
            'product_id' => $product->product_id,
            'change'     => $request->quantity,
            'reason'     => 'restock',
        ]);

        return back()->with('success', 'Stock updated.');
    }
}
