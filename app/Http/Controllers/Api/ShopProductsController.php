<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ShopProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Shop $shop)
    {
        $this->authorize('view', $shop);

        $search = $request->get('search', '');

        $products = $shop
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'in:inactive,active'],
            'image' => ['nullable', 'image', 'max:1024'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $shop->products()->create($validated);

        return new ProductResource($product);
    }
}
